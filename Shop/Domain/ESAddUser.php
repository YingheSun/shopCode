<?php

    class Domain_ESAddUser {

        public function useradd($data) {
            //创建用户
            $user     = $this->makeUser($data);
            //给用户添加各个功能数据
//            $this->addPermissions($data->type , $user['id'] , $data->shopid);
            $UserInfo = new Model_User();
            return $UserInfo->getuserInfoById($user['id']);
        }

        public function addUserInfo($data) {
            $Model_User = new Model_User();
            $Model_User->updateshoperInfo($data->id , $data->name , $data->phone , $data->uuid);
            $UserInfo   = new Model_User();
            $info       = $UserInfo->getuserInfoByIdOne($data->id);
            $this->addPermissions($data->type , $data->id , $info['bandto']);
            $UserInfo   = new Model_User();
            return $UserInfo->getuserInfoById($data->id);
        }

        public function makeUser($data) {
            $getPhone   = new Domain_ESRandomPws();
            $phone      = $getPhone->randpw(13 , 'CHAR');
            $getPwd     = new Domain_ESRandomPws();
            $pwd        = $getPwd->randpw(25 , 'ALL');
            $Model_User = new Model_User();
            if ($data->type == 1) {
                $Model_User->addShopUser($pwd , $phone , $data->shopid , "Shoper");
            } else {
                $Model_User->addShopUser($pwd , $phone , $data->shopid , "Master");
            }
//            $retArr     = array('phone' => $phone , 'pwd' => $pwd);
//            $retInfo    = array($retArr);
            $UserInfo = new Model_User();
            return $UserInfo->getUserInfo($phone , $pwd);
        }

        public function addPermissions($type , $userid , $shopid) {
            $this->makePermission($type , $userid , $shopid , "cardin");
            $this->makePermission($type , $userid , $shopid , "scanin");
            $this->makePermission($type , $userid , $shopid , "scanout");
            $this->makePermission($type , $userid , $shopid , "scanchg");
            $this->makePermission($type , $userid , $shopid , "plat");
            $this->makePermission($type , $userid , $shopid , "my");
            $this->makePermission($type , $userid , $shopid , "manage");
        }

        public function makePermission($type , $userid , $shopid , $permissionType) {
            if ($type == 1) {
                $Model_permission = new Model_Permission();
                $Model_permission->makePermissionWithShoper($userid , $shopid , $permissionType);
            } else if ($type == 2) {
                $Model_permission = new Model_Permission();
                $Model_permission->makePermissionWithMaster($userid , $shopid , $permissionType);
            }
        }

    }
    