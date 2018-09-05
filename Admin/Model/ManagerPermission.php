<?php

    class Model_ManagerPermission extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'permission';
        }

        public function getLoginPermission($data) {
            return $this->getORM()->select('permission')->where("userid" , $data->userid)->where("shopid" , $data->shopid)->where("permissiontype_id" , 22)->fetchrow();
        }

    }
    