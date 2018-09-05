<?php

    class Domain_Inflow {

        /**
         * 入库扫码流水
         */
        public function inFlow($data) {
            DI()->logger->info($data->order , $data->barcode);
            //入库订单状态查询
            $this->checkStates($data->order);
            //许可查询
//            $permission = new Domain_Permission();
//            $permission->orderPermission($data->reqid , $data->order , "scanin");
            //锁定
            $this->changeToLockState($data->order);
            //增添order数据
            $this->addFlow($data);
            //释放
            $this->releaseState($data->order);
            //获取返回的数据
            //$Model_returnOrderInfo = new Model_Inflow();
            //return $Model_returnOrderInfo->getOrderInflowInfo($data->order);
            return $this->getReturnData($data->order);
        }

        public function getReturnData($order) {
            $Model_returnOrderInfo = new Model_Inflow();
            $retData               = $Model_returnOrderInfo->getOrderInflowInfo($order);
            $orderInfo             = new Model_Orders();
            $OrderInfo             = $orderInfo->getOrderInfo($order);
            $total                 = 0;
            $number                = 0;
            $managed_count         = 0;
            $unmanaged_count       = 0;
            foreach ((array) $retData as $key => $val) {
                if ($val['id']) {
                    $counts          = new Model_Inflow();
                    $barcode         = $retData[$key]['barcode'];
                    $count           = $retData[$key]['number'] * $retData[$key]['price'];
                    $counts->updateCountInfo($barcode , $order , $count);
                    $total           = $total + $count;
                    $number ++;
//                    $getGoodsManagedCheck = new Model_Goods();
//                    $goodsInfo = $getGoodsManagedCheck->searchGoodOne($retData[$key]['barcode'] , $OrderInfo['storeid']);
                    $retType         = $this->getUnManagedNum($retData[$key]['barcode'] , $OrderInfo['storeid']);
                    $managed_count   = $managed_count + $retType;
                    $unmanaged_count = $unmanaged_count + (1 - $retType);
                }
            }
            $Model_returnOrderInfo2 = new Model_Inflow();
            $retData2               = $Model_returnOrderInfo2->getOrderInflowInfo($order);
            $retOrder               = array("total" => $total , "linecount" => $number , "managed" => $managed_count , "unmanaged" => $unmanaged_count , "retlist" => $retData2);
            $retOrderInfo           = array($retOrder);
            //$retOrder               = array_merge($arrCount , $retData2);
            return $retOrderInfo;
        }

        public function getUnManagedNum($order , $store) {
            $getGoodsManagedCheck = new Model_Goods();
            $goodsInfo            = $getGoodsManagedCheck->searchGoodOne($order , $store);
            if ($goodsInfo) {
                return 1;
            } else {
                return 0;
            }
        }

        public function checkStates($order) {
            $OrderStatesCheck = new Model_Orders();
            $state            = $OrderStatesCheck->getOrderInfo($order);
            if ($state['states'] != 1) {
                throw new PhalApi_Exception_BadRequest(T('too quick to scan') , 111);
            }
            return $state;
        }

        public function addManageInfo($barcode , $item_name) {
            if (empty($item_name)) {
                DI()->logger->info("条码未登录：" , $barcode);
                $Model_AddManageBarcode = new Model_BarcodeManage();
                $Model_AddManageBarcode->addManageInfo($barcode);
            } else {
                DI()->logger->info("类别未登录：" , $barcode);
                $Model_AddManageBarcode = new Model_BarcodeManage();
                $Model_AddManageBarcode->addTypeManageInfo($barcode);
            }
        }

        public function changeToLockState($order) {
            $changeOrderStates = new Domain_Order();
            $changeOrderStates->changeOrderStates($order , 5);
        }

        public function releaseState($order) {
            $releaseOrderStates = new Domain_Order();
            $releaseOrderStates->changeOrderStates($order , 1);
        }

        public function getOrderInfo($data) {
            $Model_checkGood = new Model_Inflow();
            return $Model_checkGood->searchGoodinorder($data->barcode , $data->order);
        }

        public function addFlow($data) {
            $code = $this->getOrderInfo($data);
            if ($code) {
                $Model_increaseGood = new Model_Inflow();
                $Model_increaseGood->increaseGoodinorder($data);
            } else {
                $store        = new Model_Orders();
                $storeid      = $store->getOrderInfo($data->order);
                $Domain_getID = new Domain_Barcode();
                $id           = $Domain_getID->getbarcodeinfo($data->barcode);
                //将未管理的信息传到管理表去
                if (empty($id['typekind'])) {
                    $this->addManageInfo($data->barcode , $id['item_name']);
                }
                $Domain_getName = new Model_Goods();
                $info           = $Domain_getName->searchShopGood($data->barcode , $storeid['shopid']);
                //$goodname       = $info['goods_name'];
                if (empty($info['goods_name'])) {
                    $goodname           = $id['item_name'];
                    $Model_addorderinfo = new Model_Inflow();
                    $Model_addorderinfo->insertflow($data , $goodname , "未管理商品" , 0);
                } else {
                    $Model_addorderinfo = new Model_Inflow();
                    $Model_addorderinfo->insertflow($data , $goodname , "已管理商品" , $info['cost']);
                }
            }
        }

        public function addTransformInFlow($order , $number , $barcode , $other , $name) {
//            $Model_checkGood    = new Model_Inflow();
//            $rs                 = $Model_checkGood->searchGoodinorder($barcode , $order);
//            if($rs){
//                $Model_addorderinfo = new Model_Inflow();
//                $Model_addorderinfo->addGoodToOrder($barcode , $order , $number);
//            }
            $Model_addorderinfo = new Model_Inflow();
            $Model_addorderinfo->insertFlowWithCode($barcode , $number , $order , $other , $name);
        }

    }
    