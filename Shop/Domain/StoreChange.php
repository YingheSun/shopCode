<?php

    class Domain_StoreChange {

        /**
         * 转换库房扫码
         * @param type $data
         * @throws PhalApi_Exception_BadRequest
         */
        public function scanChange($data) {
            //检测
            $this->checkStates($data);
            //许可查询
            //$permission  = new Domain_Permission();
            //$permission->orderPermission($data->reqid , $data->order , "scanChange");
            //锁定
            $this->getStateLock($data);
            //从库房扣除商品，告警
            $getGood     = new Domain_Outflow();
            $getGood->addOutFlow($data);
            //释放
            $this->releaseLock($data);
            $getOutOrder = new Model_Outflow();
            return $getOutOrder->getOrderOutflowInfo($data->order);
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

        public function commitChangeOrder($data) {
            //出库
            $outStore    = new Domain_Order();
            $outStore->OutOrderExec($data->order , $data->reqid , $data->shopid , $data->storeout);
            //入库流水
            $inStoreFlow = new Domain_Order();
            $inStoreFlow->zOrderExec($data->order , $data->shopid , $data->storeto);
            //入库
            $inStore     = new Domain_Order();
            return $inStore->inOrderExec($data->order , $data->shopid , $data->storeto);
        }

    }
    