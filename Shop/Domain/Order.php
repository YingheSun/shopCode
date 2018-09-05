<?php

    class Domain_Order {

        /**
         * 创建入库订单
         * 20160620
         */
        public function CreateInOrder($seralnumber , $data) {
            $Model_Store = new Model_Store();
            $storeInfo   = $Model_Store->getStoreInfo($data->storeid);
            if (!$storeInfo) {
                throw new PhalApi_Exception_BadRequest(T('no Store') , 301);
            }
            $Model_addorder = new Model_Orders();
            $rs             = $Model_addorder->addOrder($seralnumber , $data->storeid , 1 , $data->shopid , $data->reqid);
            if ($rs) {
                return $seralnumber;
            }
        }

        /**
         * 创建出库订单
         * 20160620
         */
        public function CreateOutOrder($seralnumber , $data) {
//            $Model_Store = new Model_Store();
//            $storeInfo   = $Model_Store->getStoreInfo($storeid);
            $Model_Store = new Model_Store();
            $storeInfo   = $Model_Store->getDefaultStore($data->shopid);
            if (!$storeInfo) {
                throw new PhalApi_Exception_BadRequest(T('no Store') , 301);
            }
            $Model_addorder = new Model_Orders();
            $rs             = $Model_addorder->addOrder($seralnumber , $storeInfo['id'] , 2 , $data->shopid , $data->reqid);
            if ($rs) {
                return $seralnumber;
            }
        }

        /**
         * 创建转库订单
         * 20160620
         */
        public function CreateChangeStoreOrder($seralnumber , $data) {
            $Model_Store = new Model_Store();
            $storeInfo   = $Model_Store->getStoreInfo($data->storeid);
            if (!$storeInfo) {
                throw new PhalApi_Exception_BadRequest(T('no Store') , 301);
            }
            $Model_Store2 = new Model_Store();
            $storeInfo2   = $Model_Store2->getStoreInfo($data->storeinto);
            if (!$storeInfo2) {
                throw new PhalApi_Exception_BadRequest(T('no Store') , 301);
            }
            $Model_addorder = new Model_Orders();
            $Model_addorder->addOrder($seralnumber , $data->storeid , 3 , $data->shopid , $data->reqid);
            $rs             = $Model_addorder->updateInto($seralnumber , $data->storeinto);
            if ($rs) {
                return $seralnumber;
            }
        }

        /**
         * 转换订单状态 
         */
        public function changeOrderStates($ordernum , $states) {
            $Model_Order = new Model_Orders();
            return $Model_Order->changeOrderStates($ordernum , $states);
        }

        /**
         * 获取订单详细信息
         */
        public function getOrder($data) {
            //$Model_checkGood = new Model_Inflow();
            //return $Model_checkGood->getOrderInfo($order);
            $retOrder = new Domain_Inflow();
            return $retOrder->getReturnData($data->order);
        }
        
        public function getOriOrder($data) {
            $Model_checkGood = new Model_Inflow();
            return $Model_checkGood->getOrderInfo($data->order);
        }
        
        /**
         * 获取订单详细信息
         */
        public function getoutOrder($data) {
            //$Model_checkGood = new Model_Outflow();
            //return $Model_checkGood->getOrderInfo($data->order);
            $retOrder = new Domain_Outflow();
            return $retOrder->getOutReturn($data->order);
        }

        /**
         * 获取订单信息
         */
        public function getOrderInfo($order) {
            $Model_checkGood = new Model_Orders();
            return $Model_checkGood->getOrderInfo($order);
        }

        /**
         * 获取订单信息
         */
        public function getChgOrderInfo($data) {
            $Model_checkGood = new Model_Outflow();
            return $Model_checkGood->getOrderOutflowInfo($data->order);
        }

        /**
         * 修改入库订单信息
         */
        public function changeorderinfo($data) {
            //$Domain_getID       = new Domain_Barcode();
            //$id                 = $Domain_getID->searchInfoWithCode($data->barcode);
            $Model_addorderinfo = new Model_Inflow();
            $Model_addorderinfo->updateOrderInfo($data);
            return $this->getOrder($data);
        }

        /**
         * 修改出库订单信息
         */
        public function changeoutorderinfo($data) {
            $Model_Store        = new Model_Store();
            $storeInfo          = $Model_Store->getDefaultStore($data->shopid);
            $releaseOrderStates = new Domain_Order();
            $releaseOrderStates->changeOrderStates($data->order , 6);
            $getGoodId          = new Model_Goods();
            $good_id            = $getGoodId->searchGoodOne($data->barcode , $storeInfo['id']);
            $getGoonNumber      = new Model_Storage();
            $goodStorageNumber  = $getGoonNumber->searchGood($good_id['id'] , $storeInfo['id']);
            $good_num           = $data->number;
            if (intval($good_num) > intval($goodStorageNumber['number'])) {
                $releaseOrderStates = new Domain_Order();
                $releaseOrderStates->changeOrderStates($data->order , 1);
                throw new PhalApi_Exception_BadRequest(T('not enough storeage of this good') , 113);
            }
            $Model_addorderinfo = new Model_Outflow();
            $info               = $Model_addorderinfo->updateOrderInfo($data);
            $Model_discount     = new Model_Outflow();
            if ($data->discount != 0) {
                $Model_discount->updateDiscount($data->barcode , $data->order , $data->discount , "优惠");
            }
            DI()->logger->info("$data->order 修改信息 $data->barcode , $good_num" , $info);
            $Model_checkGood = new Model_Outflow();
            $good_number     = $Model_checkGood->searchGoodinfoinorder($data->barcode , $data->order);
            $leftnum         = $goodStorageNumber['number'] - $good_number['number'];
            if (intval($leftnum) > intval($goodStorageNumber['warningline'])) {
                $Model_addWarninginfo = new Model_Outflow();
                $Model_addWarninginfo->addWarningFlag($data->order , $data->barcode , "NO");
            } else {
                $storeid              = $storeInfo['id'];
                DI()->logger->info("库存报警：$storeid" , $leftnum - $goodStorageNumber['warningline']);
                $Model_addWarninginfo = new Model_Outflow();
                $Model_addWarninginfo->addWarningFlag($data->order , $data->barcode , $leftnum - $goodStorageNumber['warningline']);
            }
            return $this->getoutOrder($data);
        }

        /**
         * 提交订单入库
         */
        public function commitOrder($data) {
            //准备，检查
            /**
             * 订单状态：进入订单
             * 1.创建
             * 2.准备，检查通过，可处理
             * 3.完成
             */
            if ($this->StatusCheck($data->order) == 1) {
                $this->updateResponser($data->order , $data->uid);
                //处理订单内容
                /**
                 * 将入库流处理到库存中
                 * 将商品信息更新
                 * 转换为处理完成状态
                 */
                $orderinfo = $this->getOriOrder($data);
                foreach ((array) $orderinfo as $key => $val) {
                    if ($val['id']) {
                        $this->execGoodsInStore($orderinfo[$key]['barcode'] , $data->shopid , $orderinfo[$key]['price'] , $data->storeid , $orderinfo[$key]['number'] , $orderinfo[$key]['goodname']);
                    }
                }
                $this->changeOrderStates($data->order , 3);
            } else {
                throw new PhalApi_Exception_BadRequest(T('has been excluted') , 112);
            }
            if ($data->expense) {
                $updateExpense = new Model_Orders();
//                $updateExpense->updateCount($data->order , $data->count , $data->expense);
                $updateExpense->updateCount($data->order , $data->count , $data->expense , $data->moneyin , $data->moneyout);
            }
            //返回
            DI()->logger->info('订单入库' , $data->order);
            return $this->getOrder($data);
        }

        /**
         * 提交订单出库
         */
        public function commitSellingOrder($data) {
            //准备，检查
            /**
             * 订单状态：出库订单
             * 1.创建
             * 2.准备，检查通过，可处理
             * 3.完成
             */
            $Model_Store = new Model_Store();
            $storeid = $Model_Store->getDefaultStore2($data->shopid);
            if ($this->StatusCheck($data->order) == 1) {
                $this->updateResponser($data->order , $data->userid);
                //处理订单内容
                /**
                 * 将入库流处理到库存中
                 * 将商品信息更新
                 * 转换为处理完成状态
                 */
                $orderinfo = $this->getoutOrder($data->order);
                foreach ((array) $orderinfo as $key => $val) {
                    if ($val['id']) {
                        $this->execGoodsOutStore($orderinfo[$key]['barcode'] , $data->shopid , $storeid['id'] , $orderinfo[$key]['number']);
                    }
                }
                if ($data->expense) {
                    $updateExpense = new Model_Orders();
                    $updateExpense->updateCount($data->order , $data->count , $data->expense , $data->moneyin , $data->moneyout);
                }
                $this->changeOrderStates($data->order , 3);
                //返回
                DI()->logger->info('订单出库' , $data->order);
                return $orderinfo;
            } else {
                throw new PhalApi_Exception_BadRequest(T('has been selled') , 302);
            }
        }

        /**
         * 入库处理
         */
        public function execGoodsInStore($barcode , $shopid , $cost , $storgeid , $number , $goodname) {
            //录入未管理的商品
            $Model_UGoods = new Model_UGoods();
            $goodInfo    = $Model_UGoods->insertGoods($shopid , $barcode , $storgeid , $goodname);
            $getgoods    = new Model_Goods();
            $info        = $getgoods->searchGoodOne($barcode , $storgeid);
            if (!empty($cost) && $info) {
                $Model_Goods1 = new Model_Goods();
                $Model_Goods1->updateGoodCost($barcode , $storgeid , $cost);
            } else if (!empty($cost)) {
                $Model_Goods1 = new Model_UGoods();
                $Model_Goods1->updateGoodCost($barcode , $storgeid , $cost);
            }
            if ($info) {
                $Model_Storage = new Model_Storage();
                $Model_Storage->insertStore($storgeid , $number , $goodInfo['id']);
            }
        }

        /**
         * 出库处理
         */
        public function execGoodsOutStore($barcode , $shopid , $storgeid , $number) {
            $Model_Goods   = new Model_Goods();
            //$goodInfo      = $Model_Goods->insertGoods($shopid , $barcode , $storgeid);
            $goodInfo      = $Model_Goods->searchGoodOne($barcode , $storgeid);
            $Model_Storage = new Model_Storage();
            $Model_Storage->outStore($storgeid , $number , $goodInfo['id']);
        }

        /**
         * 设置签单人
         */
        public function updateResponser($ordernum , $signer) {
            $Model_Order = new Model_Orders();
            return $Model_Order->setResponser($ordernum , $signer);
        }

        /**
         * 订单状态准备
         */
        public function StatusCheck($ordernum) {
            $Model_Order = new Model_Orders();
            $orderinfo   = $Model_Order->getOrderInfo($ordernum);
            return $orderinfo['states'];
        }

        /**
         * 提交订单出库
         */
        public function OutOrderExec($order , $userid , $shopid , $storeid) {
            //准备，检查
            /**
             * 订单状态：出库订单
             * 1.创建
             * 2.准备，检查通过，可处理
             * 3.完成
             */
            if ($this->StatusCheck($order) == 1) {
                $this->updateResponser($order , $userid);
                //处理订单内容
                /**
                 * 将入库流处理到库存中
                 * 将商品信息更新
                 * 转换为处理完成状态
                 */
                $orderinfo = $this->getoutOrder($order);
                foreach ((array) $orderinfo as $key => $val) {
                    if ($val['id']) {
                        $this->execGoodsOutStore($orderinfo[$key]['barcode'] , $shopid , $storeid , $orderinfo[$key]['number']);
                    }
                }
                $this->changeOrderStates($order , 6);
                //返回
                DI()->logger->info('订单转库出库' , $order);
            } else {
                throw new PhalApi_Exception_BadRequest(T('has been selled') , 302);
            }
        }

        /**
         * 提交订单入库
         */
        public function inOrderExec($order , $shopid , $storeid) {
            //准备，检查
            /**
             * 订单状态：进入订单
             * 1.创建
             * 2.准备，检查通过，可处理
             * 3.完成
             */
            if ($this->StatusCheck($order) == 7) {
                //处理订单内容
                /**
                 * 将入库流处理到库存中
                 * 将商品信息更新
                 * 转换为处理完成状态
                 */
                $orderinfo = $this->getOrder($order);
                foreach ((array) $orderinfo as $key => $val) {
                    if ($val['id']) {
                        $this->execGoodsInStore($orderinfo[$key]['barcode'] , $shopid , $orderinfo[$key]['price'] , $storeid , $orderinfo[$key]['number'] , $orderinfo[$key]['goodname']);
                    }
                }
                $this->changeOrderStates($order , 3);
            } else {
                throw new PhalApi_Exception_BadRequest(T('has been excluted') , 112);
            }
            //返回
            DI()->logger->info('订单转库入库' , $order);
            return $orderinfo;
        }

        /**
         * 提交订单入库
         */
        public function zOrderExec($order) {
            //准备，检查
            /**
             * 订单状态：进入订单
             * 1.创建
             * 2.准备，检查通过，可处理
             * 3.完成
             */
            if ($this->StatusCheck($order) == 6) {
                //处理订单内容
                /**
                 * 将入库流处理到库存中
                 * 将商品信息更新
                 * 转换为处理完成状态
                 */
                $orderinfo = $this->getoutOrder($order);
                foreach ((array) $orderinfo as $key => $val) {
                    if ($val['id']) {
                        //$this->execGoodsInStore($orderinfo[$key]['barcode'] , $shopid , $orderinfo[$key]['price'] , $storeid , $orderinfo[$key]['number'] , $orderinfo[$key]['goodname']);

                        $inflow = new Domain_Inflow();
                        $inflow->addTransformInFlow($order , $orderinfo[$key]['number'] , $orderinfo[$key]['barcode'] , "转库" , $orderinfo[$key]['goodname']);
                    }
                }
                $this->changeOrderStates($order , 7);
            } else {
                throw new PhalApi_Exception_BadRequest(T('has been excluted') , 112);
            }
            //返回
            DI()->logger->info('订单转库入库流水完成' , $order);
            return $orderinfo;
        }

        /**
         * 订单现金管理
         */
        public function OrderMoney($data) {
            $updateMoney = new Model_Orders();
            return $updateMoney->updateMoney($data->orderid , $data->count , $data->expense , $data->moneyin , $data->moneyout);
        }

    }
    