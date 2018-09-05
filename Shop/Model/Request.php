<?php

    class Model_Request extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'request';
        }

        /**
         * 新增商店
         */
        public function shopaddrequest($data) {
            return $this->getORM()
                            ->insert(array(
                                "requesterid" => $data->requesterid ,
                                "telephone"   => $data->telephone ,
                                "shopname"    => $data->shopname ,
                                "address"     => $data->address ,
                                "gpsx"        => $data->gpsx ,
                                "gpsy"        => $data->gpsy ,
                                "owner"       => $data->owner ,
                                "email"       => $data->email ,
                                "requesttype" => $data->requesttype ,
                                "function1"   => $data->function1 ,
                                "function2"   => $data->function2 ,
                                "function3"   => $data->function3 ,
                                "function4"   => $data->function4 ,
                                "function5"   => $data->function5 ,
                                "function6"   => $data->function6 ,
                                "function7"   => $data->function7 ,
                                "function8"   => $data->function8 ,
                                "function9"   => $data->function9 ,
                                "function10"  => $data->function10 ,
                                "isdone"      => "no" ,
            ));
        }

        public function getUnDoneShop() {
            return $this->getORM()->where("isdone" , "no")->fetchall();
        }

        public function uploadskip($id) {
            return $this->getORM()->where("id" , $id)->update(array("isdone" => "skip"));
        }

        public function uploadDone($id) {
            return $this->getORM()->where("id" , $id)->update(array("isdone" => "done"));
        }

        public function getRequestInfo($id) {
            return $this->getORM()->where("id" , $id)->fetch();
        }

        public function getRequestList($requesterid) {
            return $this->getORM()->where("requesterid" , $requesterid)->fetchall();
        }

    }
    