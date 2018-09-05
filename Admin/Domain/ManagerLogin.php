<?php

    class Domain_ManagerLogin {

        public function LoginCheck($data) {
            $check      = new Model_ManagerPermission();
            $permission = $check->getLoginPermission($data);
            $ordercheck = new Model_ManagerLogin();
            $order      = $ordercheck->searchInfoWithqrcode($data->loginorder);
            if ($order) {
                throw new PhalApi_Exception_BadRequest(T("order used") , 921);
            }
            if (!$permission) {
                throw new PhalApi_Exception_BadRequest(T("do not have permission to login") , 920);
            } else if ($permission['permission'] == 'n') {
                throw new PhalApi_Exception_BadRequest(T("do not have permission to login") , 920);
            }
            $login = new Model_ManagerLogin();
            $login->login($data);
            return $permission;
        }

    }
    