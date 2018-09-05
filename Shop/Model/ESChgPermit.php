<?php

  class Model_ESChgPermit extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'permission';
        }

        public function makePermitOn($id) {
           return $this->getORM()->where("id" , $id)->update(array("permission" => "y"));
        }
        
        public function makePermitOff($id) {
           return $this->getORM()->where("id" , $id)->update(array("permission" => "n"));
        }


    }
    