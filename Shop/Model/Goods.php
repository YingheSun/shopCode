<?php

    class Model_Goods extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'goods';
        }

        public function insertGoods($shopid , $barcode , $storageid , $goodname) {
            $info = $this->searchGoodOne($barcode , $storageid);
            if (!$info) {

                return $this->getORM()
                                ->insert(
                                        array(
                                            "shopid"        => $shopid ,
                                            "barcode"       => $barcode ,
                                            "onsellingflag" => 1 ,
                                            "storgeid"      => $storageid ,
                                            "time"          => time() ,
                                            "goods_name"    => $goodname ,
                                            "managetype"    => "new"
                                        )
                );
            } else {
                return $info;
            }
        }

        public function searchShopGood($barcode , $shopid) {
            return $this->getORM()->where('barcode' , $barcode)->where('shopid' , $shopid)->fetchall();
        }

        public function searchGood($barcode , $storageid) {
            return $this->getORM()->where('barcode' , $barcode)->where('storgeid' , $storageid)->fetchall();
        }

        public function searchGoodOne($barcode , $storageid) {
            return $this->getORM()->where('barcode' , $barcode)->where('storgeid' , $storageid)->fetchrow();
        }

        public function getGoodInfo($id) {
            return $this->getORM()->limit(1)->where('id' , $id)->fetchall();
        }

        public function updateGoodCost($barcode , $storageid , $cost) {
            return $this->getORM()->where('barcode' , $barcode)->where('storgeid' , $storageid)->update(array('cost' => $cost , 'time' => time()));
        }

        public function getGoodsList($shopid , $storeid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('storgeid' , $storeid)->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('storgeid' , $storeid)->fetchall();
        }

        public function getShopGoodsList($shopid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->fetchall();
        }

        public function getGoodTypeList($shopid , $type) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('goods_type' , $type)->fetchall();
        }

        public function getWaitGoodsList($shopid , $storeid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('storgeid' , $storeid)->where('managetype' , "new")->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('storgeid' , $storeid)->where('managetype' , "new")->fetchall();
        }

        public function getShopWaitGoodsList($shopid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('managetype' , "new")->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('managetype' , "new")->fetchall();
        }

        public function getDoneGoodsList($shopid , $storeid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('storgeid' , $storeid)->where('managetype' , "selling")->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('storgeid' , $storeid)->fetchall();
        }

        public function getDoneShopGoodsList($shopid , $page) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('managetype' , "selling")->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->where('managetype' , "done")->fetchall();
        }

        public function updateGoodInfo($data) {
            return $this->getORM()->where('id' , $data->goodid)->update(array('goods_name' => $data->goodname , 'cost' => $data->cost , 'lowprice' => $data->lowprice , 'price' => $data->price , 'time' => time() , 'managetype' => "done"));
        }

        public function updateGoodSaleState($id) {
            return $this->getORM()->where('id' , $id)->update(array('onsellingflag' => "2"));
        }

        public function updateGoodOffSaleState($id) {
            return $this->getORM()->where('id' , $id)->update(array('onsellingflag' => "3"));
        }

        public function updateGoodWaitState($id) {
            return $this->getORM()->where('id' , $id)->update(array('onsellingflag' => "1"));
        }

        public function getAllManagedNewGoods() {
            return $this->getORM()->where('onsellingflag' , "1")->where('managetype' , "new")->fetchall();
        }

    }
    