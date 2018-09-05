<?php

    class Domain_Outflow {

        /**
         * 出库扫码流水
         */
        public function outFlow($data) {
            //检测
            $this->checkStates($data);
            //许可查询
//            $permission = new Domain_Permission();
//            $permission->orderPermission($data->userid , $data->order , "scanout");
            //锁定
            $this->getStateLock($data);
            //添加数据,告警
            $this->addOutFlow($data);
            //释放
            $this->releaseLock($data);
            //返回列表
            //$getOutOrder = new Model_Outflow();
            //return $getOutOrder->getOrderOutflowInfo($data->order);
            return $this->getOutReturn($data->order);
        }

        public function getOutReturn($order) {

            $Model_returnOrderInfo = new Model_Outflow();
            $retData               = $Model_returnOrderInfo->getOrderOutflowInfo($order);
            $total                 = 0;
            $number                = 0;
            foreach ((array) $retData as $key => $val) {
                if ($val['id']) {
                    $counts  = new Model_Outflow();
                    $barcode = $retData[$key]['barcode'];
                    $count   = $retData[$key]['number'] * $retData[$key]['price'] - $retData[$key]['discount'];
                    $counts->updateCountInfo($barcode , $order , $count);
                    $total   = $total + $count;
                    $number ++;
                }
            }
            $Model_returnOrderInfo2 = new Model_Outflow();
            $retData2               = $Model_returnOrderInfo2->getOrderOutflowInfo($order);
            $retOrder               = array('total' => $total , 'linecount' => $number , 'warnings' => $number , 'numbers' => $number , 'other3' => $number , 'other4' => $number , 'retlist' => $retData2);
            $retOrderInfo           = array($retOrder);
            //$retOrder               = array_merge($arrCount , $retData2);
            return $retOrderInfo;
        }

        public function checkStates($data) {
            $OrderStatesCheck = new Model_Orders();
            $state            = $OrderStatesCheck->getOrderInfo($data->order);
            if ($state['states'] != 1) {
                throw new PhalApi_Exception_BadRequest(T('too quick to scan') , 111);
            }
        }

        public function getStateLock($data) {
            $changeOrderStates = new Domain_Order();
            $changeOrderStates->changeOrderStates($data->order , 5);
        }

        public function releaseLock($data) {
            $releaseOrderStates = new Domain_Order();
            $releaseOrderStates->changeOrderStates($data->order , 1);
        }

        public function addOutFlow($data) {
            $Model_Store     = new Model_Store();
            $storeInfo       = $Model_Store->getDefaultStore($data->shopid);
            $Model_checkGood = new Model_Outflow();
            $code            = $Model_checkGood->searchGoodinfoinorder($data->barcode , $data->order);
            if ($code) {
//                DI()->logger->info("test:root1" , $data->barcode);
                $good_num          = $code['number'] + $data->number;
                $getGoodId         = new Model_Goods();
                $good_ids          = $getGoodId->searchGoodOne($data->barcode , $storeInfo['id']);
                $getGoonNumber     = new Model_Storage();
                $goodStorageNumber = $getGoonNumber->searchGood($good_ids['id'] , $storeInfo['id']);
                if (intval($good_num) > intval($goodStorageNumber['number'])) {
//                    $ff                 = intval($goodStorageNumber['number']);
//                    DI()->logger->info("$data->order 库存不足 intval($good_num) >< $ff ffffffddddddfffffff" , $ff);
                    $releaseOrderStates = new Domain_Order();
                    $releaseOrderStates->changeOrderStates($data->order , 1);
                    throw new PhalApi_Exception_BadRequest(T('not enough storeage of this good') , 113);
                }
                DI()->logger->info("$data->order 扫码出库" , $data->barcode);
                $Model_increaseGood = new Model_Outflow();
                $Model_increaseGood->increaseGoodinorder($data);
            } else {

                $storeids          = $storeInfo['id'];
                $getGoodId         = new Model_Goods();
                $good_id           = $getGoodId->searchGoodOne($data->barcode , $storeids);
                $getGoonNumber     = new Model_Storage();
                $goodStorageNumber = $getGoonNumber->searchGood($good_id['id'] , $storeids);
                $good_num          = $data->number;
//                DI()->logger->info("test:root2 $good_num >< " , $goodStorageNumber['number']);
                if (intval($good_num) > intval($goodStorageNumber['number'])) {
                    $releaseOrderStates = new Domain_Order();
                    $releaseOrderStates->changeOrderStates($data->order , 1);
                    DI()->logger->info("$storeids 库存不足 $good_num" , $goodStorageNumber['number']);
                    throw new PhalApi_Exception_BadRequest(T('not enough storeage of this good') , 113);
                }
                DI()->logger->info("$data->order 扫码出库" , $data->barcode);
                $Model_addorderinfo = new Model_Outflow();
                $Model_addorderinfo->insertflow2($data , $storeids);
            }
            $good_number = $Model_checkGood->searchGoodinfoinorder($data->barcode , $data->order);
            $leftnum     = $goodStorageNumber['number'] - $good_number['number'];
            if (intval($leftnum) > intval($goodStorageNumber['warningline'])) {
                $Model_addWarninginfo = new Model_Outflow();
                $Model_addWarninginfo->addWarningFlag($data->order , $data->barcode , "NO");
            } else {
                DI()->logger->info("库存报警:$storeids" , $leftnum - $goodStorageNumber['warningline']);
                $Model_addWarninginfo = new Model_Outflow();
                $Model_addWarninginfo->addWarningFlag($data->order , $data->barcode , $leftnum - $goodStorageNumber['warningline']);
            }
        }

    }
    