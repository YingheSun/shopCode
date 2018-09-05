<?php

    class Model_BarcodeManage extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'barcode_mamage';
        }

        /**
         *  信息缺失条码表管理数据添加
         */
        public function addManageInfo($barcode) {
            $existinfo = $this->CheckExist($barcode);
            if (!$existinfo) {
                return $this->getORM()
                                ->insert(array(
                                    "barcode" => $barcode ,
                                    "state"   => 1 ,
                                    "time"    => time() ,
                ));
            }
        }

        /**
         *  信息缺失条码表管理数据添加
         */
        public function addTypeManageInfo($barcode) {
            $existinfo = $this->CheckExist($barcode);
            if (!$existinfo) {
                return $this->getORM()
                                ->insert(array(
                                    "barcode" => $barcode ,
                                    "state"   => 2 ,
                                    "time"    => time() ,
                ));
            }
        }

        public function CheckExist($barcode) {
            return $this->getORM()->where("barcode" , $barcode)->fetchrow();
        }

    }
    