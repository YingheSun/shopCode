<?php

    class Model_ManagerLogin extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'manager_login';
        }

        public function login($data) {
            $this->getORM()
                    ->insert(array(
                        "qrcode" => $data->loginorder ,
                        "shopid" => $data->shopid ,
                        "userid" => $data->userid ,
                        "time"   => time()
            ));
            return;
        }

        public function searchInfoWithqrcode($code) {
            return $this->getORM()->where("qrcode" , $code)->fetchrow();
        }
        
        

    }
    