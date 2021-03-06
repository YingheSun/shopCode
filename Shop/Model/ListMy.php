<?php

    class Model_ListMy extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'my_list';
        }

        /**
         *  查询表数据
         */
        public function getRootList($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("isroot" , "YES")->fetchall();
        }

        public function getOtherList($shopid , $type) {
            return $this->getORM()->where("shopid" , $shopid)->where("type" , $type)->fetchall();
        }

    }
    