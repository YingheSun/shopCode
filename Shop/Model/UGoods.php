<?php

    class Model_UGoods extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'goods_unmanage';
        }

        public function insertGoods($shopid , $barcode , $storageid , $goodname) {
            $getgoods = new Model_Goods();
            $info     = $getgoods->searchGoodOne($barcode , $storageid);
            $Info2    = $this->searchGoodOne($barcode , $storageid);
            if (!$info && !$Info2) {
                return $this->getORM()
                                ->insert(
                                        array(
                                            "shopid"        => $shopid ,
                                            "barcode"       => $barcode ,
                                            "onsellingflag" => 3 ,
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

        public function updateGoodCost($barcode , $storageid , $cost) {
            return $this->getORM()->where('barcode' , $barcode)->where('storgeid' , $storageid)->update(array('cost' => $cost , 'time' => time()));
        }

        public function searchGoodOne($barcode) {
            return $this->getORM()->where('barcode' , $barcode)->fetchrow();
        }

        public function getWaitGoodsList($shopid) {
//            return $this->getORM()->limit($page * 10 , 10)->where('shopid' , $shopid)->where('storgeid' , $storeid)->where('managetype' , "new")->fetchall();
            return $this->getORM()->where('shopid' , $shopid)->fetchall();
        }

        public function getGoodInfo($id) {
            return $this->getORM()->limit(1)->where('id' , $id)->fetchall();
        }

        public function makeInfoToGoods($id) {
            $sql    = 'insert into mrp_goods select * from mrp_goods_unmanage where mrp_goods_unmanage.id =:id;';
            $params = array(':id' => $id);
            return $this->getORM()->queryAll($sql , $params);
        }

        public function updateGoodInfo($data) {
            return $this->getORM()->where('id' , $data->goodid)->update(array('barcode' => $data->barcode , 'goods_name' => $data->goodname , 'cost' => $data->cost , 'lowprice' => $data->lowprice , 'price' => $data->price , 'time' => time() , 'managetype' => "done"));
        }

        public function dropInfoWithId($id) {
            return $this->getORM()->where('id' , $id)->delete();
        }

    }
    