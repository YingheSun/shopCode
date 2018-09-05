<?php

    class Domain_Permission {

        /**
         * 权限查询
         */
        public function Permission($shopid , $userid , $type) {
            $permission = DI()->notorm->permission->where("shopid" , $shopid)->where("userid" , $userid)->where("type" , $type)->fetchrow();
            if ($permission['permission'] == "n" || empty($permission)) {
                throw new PhalApi_Exception_BadRequest(T('no permission') , 300);
            }
        }

        public function orderPermission($userid , $order , $type) {
            $OrderStatesCheck = new Model_Orders();
            $orderInfo        = $OrderStatesCheck->getOrderInfo($order);
            $shopid           = $orderInfo['shopid'];
            $permission       = DI()->notorm->permission->where("shopid" , $shopid)->where("userid" , $userid)->where("type" , $type)->fetchrow();
            //DI()->logger->debug($permission);
            if ($permission['permission'] == "n" || empty($permission)) {
                throw new PhalApi_Exception_BadRequest(T('no permission') , 300);
            }
        }

        public function changePermission($data) {
            $Model_UserPermission  = new Model_Permission();
            $Model_UserPermission->updateUserPermissionInfo($data);
            $Model_UserPermission2 = new Model_Permission();
            return $Model_UserPermission2->getUserPermissionInfo($data);
        }

    }
    