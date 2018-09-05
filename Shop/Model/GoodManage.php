<?php

    class Model_GoodManage extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'barcode_self_manage';
        }

        /**
         *  信息缺失条码表管理数据添加
         */
        public function addManageInfo($barcode , $shopid , $state) {
            $existinfo = $this->CheckExist($barcode);
            if (!$existinfo) {
                return $this->getORM()
                                ->insert(array(
                                    "barcode" => $barcode ,
                                    "state"   => $state ,
                                    "time"    => time() ,
                                    "shopid"  => $shopid
                )
                                        );
            }else{
                return $existinfo;
            }
        }

        public function getAllManageList($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("state" , 1)->fetchall();
        }

        public function getTypeManageList($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("state" , 2)->fetchall();
        }

        public function CheckExist($barcode , $shopid) {
            return $this->getORM()->where("barcode" , $barcode)->where("shopid" , $shopid)->fetchrow();
        }

        public function getDefaultManageList($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("state < ?" , 3)->fetchall();
        }

    }
    