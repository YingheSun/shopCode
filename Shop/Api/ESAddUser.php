<?php

    class Api_ESAddUser extends PhalApi_Api {

        public function getRules() {
            return array(
                'getUser'     => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '店铺号') ,
                    'type' => array(
                        'name'    => 'type' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '类型') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
                'addUserInfo' => array(
                    'id'    => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => 'id号') ,
                    'name'  => array(
                        'name'    => 'name' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '姓名') ,
                    'phone' => array(
                        'name'    => 'phone' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '手机号') ,
                    'type' => array(
                        'name'    => 'type' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '类型') ,
                    'uuid'  => array(
                        'name'    => 'uuid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '手机标识') ,
                    'reqid' => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
            );
        }

        public function getUser() {
            $Domain_User = new Domain_ESAddUser();
            //创建用户信息
            return $Domain_User->useradd($this);
        }

        public function addUserInfo() {
            $Domain_User = new Domain_ESAddUser();
            //创建用户信息
            return $Domain_User->addUserInfo($this);
        }

    }
    