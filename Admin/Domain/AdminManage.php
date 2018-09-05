<?php

    class Domain_AdminManage {

        public function adminadd($data) {
            $Model_CheckLevel = new Model_AdminManage();
            $admininfo        = $Model_CheckLevel->getAdminInfo($data->adminid);
            if ($admininfo['level'] < $data->level) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->adminadd($data);
            } else {
                throw new PhalApi_Exception_BadRequest(T("level not allowed") , 922);
            }
        }

        public function deleteadmin($data) {
            $Model_CheckLevel = new Model_AdminManage();
            $admininfo        = $Model_CheckLevel->getAdminInfo($data->adminid);
            if ($admininfo['level'] == 0) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminDisabled($data->delid);
            } else if ($data->adminid == $data->delid) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminDisabled($data->delid);
            } else {
                throw new PhalApi_Exception_BadRequest(T("not allow") , 923);
            }
        }

        public function adminlogin($data) {
            $Model_Checklogin = new Model_AdminManage();
            return $Model_Checklogin->getAdminInfoByPhoneandPassword($data);
        }

        public function changeadminpassword($data) {
            $Model_CheckLevel = new Model_AdminManage();
            $admininfo        = $Model_CheckLevel->getAdminInfo($data->adminid);
            if ($admininfo['level'] == 0) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminpassword($data->id , $data->password);
            } else if ($data->adminid == $data->id) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminpassword($data->id , $data->password);
            } else {
                throw new PhalApi_Exception_BadRequest(T("not allow") , 923);
            }
        }

        public function changeadminlevel($data) {
            $Model_CheckLevel = new Model_AdminManage();
            $admininfo        = $Model_CheckLevel->getAdminInfo($data->adminid);
            if ($admininfo['level'] == 0) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminLevel($data->id , $data->level);
            } else if ($data->adminid == $data->id) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminLevel($data->id , $data->level);
            } else {
                throw new PhalApi_Exception_BadRequest(T("not allow") , 923);
            }
        }

        public function changeadminnickname($data) {
            $Model_CheckLevel = new Model_AdminManage();
            $admininfo        = $Model_CheckLevel->getAdminInfo($data->adminid);
            if ($admininfo['level'] == 0) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminnickname($data->id , $data->nickname);
            } else if ($data->adminid == $data->id) {
                $Model_addAdmin = new Model_AdminManage();
                return $Model_addAdmin->setAdminLevel($data->id , $data->nickname);
            } else {
                throw new PhalApi_Exception_BadRequest(T("not allow") , 923);
            }
        }

    }
    