<?php

    class Api_ManagerLogin extends PhalApi_Api {

        public function getRules() {
            return array(
                'login' => array(
                    'shopid'     => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'userid'     => array(
                        'name'    => 'userid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '用户id') ,
                    'loginorder' => array(
                        'name'    => 'loginorder' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '登录号') ,
                ) ,
            );
        }

        public function getloginorder() {
            $order_number = date('Ymd') . substr(implode(NULL , array_map('ord' , str_split(substr(uniqid() , 7 , 13) , 1))) , 0 , 8);
            $order        = "DLM$order_number";
            return $order;
        }

        public function login() {
            $Domain_ManagerLogin = new Domain_ManagerLogin();
            return $Domain_ManagerLogin->LoginCheck($this);
        }

    }
    