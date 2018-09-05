<?php

    /**
     * 管理者逻辑文件
     *
     * @author: YHS 20160623
     * 
     */
    class Domain_Manager {

        public function getAllRequest($shopid) {
            $Model_UserBand = new Model_UserBand();
            return $Model_UserBand->getRequestInfo($shopid);
        }

        public function updateRequestState($id , $state) {
            $Model_UserBand = new Model_UserBand();
            return $Model_UserBand->updateBandState($id , $state);
        }

        public function createMemberWithType($id , $type , $permissionType) {
            $Model_UserBand = new Model_UserBand();
            $Model_UserBand->updateBandState($id , 2);
            $reqinfo        = $this->getRequestInfo($id);
            if ($type == 1) {
                $Model_permission = new Model_Permission();
                $Model_permission->makePermissionWithShoper($reqinfo['user_id'] , $reqinfo['shops_id'] , $permissionType);
            } else if ($type == 2) {
                $Model_permission = new Model_Permission();
                $Model_permission->makePermissionWithMaster($reqinfo['user_id'] , $reqinfo['shops_id'] , $permissionType);
            } else {
                throw new PhalApi_Exception_BadRequest(T("this type not Exist") , 901);
            }
            $Model_UserBand1 = new Model_UserBand();
            $Model_UserBand1->updateBandState($id , 3);
            $logger          = $reqinfo['user_id'] + $reqinfo['shops_id'] + $type;
            DI()->logger->info('用户获得权限' , $logger);
            return $this->getAllRequest($reqinfo['shops_id']);
        }

        public function skipRequest($id) {
            $Model_UserBand = new Model_UserBand();
            $upstate        = $Model_UserBand->updateBandState($id , 5);
            if ($upstate === FALSE) {
                throw new PhalApi_Exception_BadRequest(T("skip Failed") , 905);
            }
        }

        public function getRequestInfo($id) {
            $Model_UserBand = new Model_UserBand();
            return $Model_UserBand->getBandInfo($id);
        }

        public function getGoodManageList($shopid) {
            $Model_GoodManage = new Model_GoodManage();
            return $Model_GoodManage->getManageList($shopid);
        }

        public function getmanagelistwithtype($data) {
            $Model_Manager = new Model_GoodManage();
            if ($data->type == "new") {
                return $Model_Manager->getAllManageList($data->shopid);
            } else if ($data->type == "typeshort") {
                return $Model_Manager->getTypeManageList($data->shopid);
            } else {
                return $Model_Manager->getDefaultManageList($data->shopid);
            }
        }

    }
    