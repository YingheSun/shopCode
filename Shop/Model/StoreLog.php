<?php

    class Model_StoreLog extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'shop_store_log';
        }

        /**
         * 新增库房
         */
        public function addStore($shopid , $storeid , $things , $respid) {

            return $this->getORM()
                            ->insert(array(
                                "shopid"  => $shopid ,
                                "storeid" => $storeid ,
                                "things"  => $things ,
                                "respid"  => $respid
            ));
        }

    }
    