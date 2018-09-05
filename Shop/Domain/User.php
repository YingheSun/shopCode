<?php

    /**
     * 用户注册接口文件
     *
     * @author: YHS 20160603
     * @author: YHS 20160619 重构
     * @author: YHS 20160720 重构
     */
    class Domain_User {

        public function useradd($data) {
            $Model_User = new Model_User();
            $uid        = $Model_User->addUser($data);
            if (!$uid) {
                throw new PhalApi_Exception_BadRequest(T("add Error") , 101);
            }
            DI()->logger->info('用户注册：' , $uid['id']);
            $Model_UserInfo = new Model_User();
            return $Model_UserInfo->getUserInfoByPhone($data->phonenum);
        }

        public function checkPhone($phonenum) {
            $Model_User = new Model_User();
            $userinfo   = $Model_User->getUserInfoByPhone($phonenum);
            if ($userinfo) {
                //用户已存在-601
                throw new PhalApi_Exception_BadRequest(T("user already exists") , 102);
            }
        }

        public function updatePassword($data) {
            $Model_User = new Model_User();
            return $Model_User->updatePassword($data->id , $data->password);
        }

        public function getUserByPhone($data) {
            $Model_User = new Model_User();
            $userinfo   = $Model_User->getUserInfoByPhone($data->phonenumber);
            if (!$userinfo) {
                //用户不存在-603
                throw new PhalApi_Exception_BadRequest(T("user not exists") , 104);
            }
            return $userinfo;
        }
        
        public function getUserById($data) {
            $Model_User = new Model_User();
            $userinfo   = $Model_User->getuserInfoById($data->userid);
            if (!$userinfo) {
                //用户不存在-603
                throw new PhalApi_Exception_BadRequest(T("user not exists") , 104);
            }
            return $userinfo;
        }

        public function login($phonenum , $password , $uuid) {
            $Model_User = new Model_User();
            $userlevel  = $Model_User->getUserInfoByPhoneandPassword($phonenum , $password);
            if (!$userlevel) {
                throw new PhalApi_Exception_BadRequest(T("login failed") , 103);
            }
            DI()->logger->info('用户登录：' , $phonenum);
            $Model_UserUUID = new Model_User();
            $Model_UserUUID->updateUUID($phonenum , $uuid);
            return $userlevel;
        }

        public function quickLogin($phonenum , $uuid) {
            $Model_User = new Model_User();
            $userlevel  = $Model_User->getuserInfoByPhoneandUUID($phonenum , $uuid);
            if (!$userlevel) {
                throw new PhalApi_Exception_BadRequest(T("login failed") , 103);
            }
            DI()->logger->info('用户快捷登录：' , $phonenum);
            return $userlevel;
        }

        public function updateBandWtihPhoneAndId($uid , $id) {
            $Model_Permissions = new Model_Permission();
            $Permission        = $Model_Permissions->getPermissionInfo($uid , $id , 25);
            if ($Permission != "y") {
                throw new PhalApi_Exception_BadRequest(T("no permission for band shop") , 301);
            }
            $Model_User = new Model_User();
            $userbanded = $Model_User->updateBandWtihPhoneAndId($uid , $id);
            if ($userbanded === FALSE) {
                throw new PhalApi_Exception_BadRequest(T("update failed") , 106);
            } else if ($userbanded === 0) {
                throw new PhalApi_Exception_BadRequest(T("has been banded") , 105);
            }
            DI()->logger->info('用户工作绑定' , "$uid+bandin+$id");
            $Model_UserInfo = new Model_User();
            return $Model_UserInfo->getuserInfoById($id);
        }

        public function searchShop($telephone) {
            $Model_Shop = new Model_Shop();
            $ids        = $Model_Shop->getShopInfo($telephone);
            if (!$ids) {
                throw new PhalApi_Exception_BadRequest(T("this shop not Exist") , 607);
            }
            return $ids;
        }

        public function getUserBandInfoByPhone($id) {
            $Model_UserLog = new Model_UserBand();
            $userBands     = $Model_UserLog->getUseBandInfoByid($id);
            if (!$userBands) {
                throw new PhalApi_Exception_BadRequest(T("no Bands") , 107);
            }
            return $userBands;
        }

        public function bandShopAdd($data) {
            $Model_AddBand = new Model_UserBand();
            DI()->logger->info('用户添加绑定' , "$data->id+bandwith+$data->bandshopid");
            return $Model_AddBand->addUserBand($data);
        }

        public function cardin($data) {
            $Model_CheckBand = new Model_User();
            $CheckState      = $Model_CheckBand->getuserInfoByIdandBand($data->userid , $data->bandshopid);
            if (!$CheckState) {
                throw new PhalApi_Exception_BadRequest(T("no permission to Bands") , 108);
            }
            $Model_AddBand = new Model_UserCard();
            DI()->logger->info('用户打卡' , "$data->userid+card+$data->bandshopid");
            $cardid        = $Model_AddBand->addCardIn($data);
            $Model_getBand = new Model_UserCard();
            return $Model_getBand->getCardinTime($cardid['id']);
        }

        public function updateMyInfo($data) {
            $Model_User = new Model_User();
            $Model_User->updateMyInfo($data->id , $data->user_name , $data->phonenum);
            $Model_UserInfo = new Model_User();
            $userinfo   = $Model_UserInfo->getuserInfoById($data->id);
            return $userinfo;
        }

    }
    