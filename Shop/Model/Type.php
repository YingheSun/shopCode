<?php

    class Model_Type extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'type';
        }

        public function addType($data) {
            return $this->getORM()
                            ->insert(array(
                                "type"       => $data->typename ,
                                "shopid"    => $data->shopid 
            ));
        }

        public function searchTypeId($type , $storageid) {
            return $this->getORM()->where('storeid' , $storageid)->where('type' , $type)->fetchrow();
        }
        
        public function getTypeList($shopid) {
            return $this->getORM()->where('shopid' , $shopid)->fetchall();
        }

    }
    