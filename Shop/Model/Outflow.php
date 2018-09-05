<?php

    class Model_Outflow extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'outflow';
        }

        public function insertflow($data) {
            $goodName = $this->getGoodsName($data);
            return $this->getORM()
                            ->insert(array(
                                "barcode"   => $data->barcode ,
                                "number"    => $data->number ,
                                "order_num" => $data->order ,
                                "other"     => "" ,
                                "time"      => time() ,
                                "shopid"    => $data->shopid ,
                                "storeid"   => $data->storeid ,
                                "goodname"  => $goodName['goods_name'] ,
                                "price"     => $goodName['price']
                                    )
            );
        }

        public function insertflow2($data , $storeid) {
            $goodName = $this->getGoodsName2($data->barcode , $storeid);
            return $this->getORM()
                            ->insert(array(
                                "barcode"   => $data->barcode ,
                                "number"    => $data->number ,
                                "order_num" => $data->order ,
                                "other"     => "无优惠" ,
                                "time"      => time() ,
                                "shopid"    => $data->shopid ,
                                "storeid"   => $storeid ,
                                "discount"  => 0 ,
                                "goodname"  => $goodName['goods_name'] ,
                                "price"     => $goodName['price']
                                    )
            );
        }

        public function searchGoodinorder($barcode , $order) {
            return $this->getORM()->select("barcode")->where("barcode" , $barcode)->where("order_num" , $order)->fetchrow();
        }

        public function searchGoodinfoinorder($barcode , $order) {
            return $this->getORM()->where("barcode" , $barcode)->where("order_num" , $order)->fetchrow();
        }

        public function increaseGoodinorder($data) {
            return $this->getORM()->where("barcode" , $data->barcode)->where("order_num" , $data->order)->update(array('number' => new NotORM_Literal("number + $data->number") , 'time' => time()));
        }

        public function getOrderInfo($order) {
            return $this->getORM()->where("order_num" , $order)->order('time DESC')->fetchall();
        }

        public function updateOrderInfo($data) {
            return $this->getORM()->where("barcode" , $data->barcode)->where("order_num" , $data->order)->update(array('number' => $data->number , 'time' => time() , 'other' => $data->other , 'price' => $data->price));
        }

        public function updateDiscount($barcode , $order , $discount , $other) {
            return $this->getORM()->where("barcode" , $barcode)->where("order_num" , $order)->update(array('discount' => $discount , 'other' => $other));
        }

        public function getGoodsName($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->searchGoodOne($data->barcode , $data->storeid);
        }

        public function getGoodsName2($barcode , $storeid) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->searchGoodOne($barcode , $storeid);
        }

        public function getOrderOutflowInfo($order) {
            //return $this->getORM()->where("order_num" , $order)->order('time DESC')->limit(5)->fetchall();
            return $this->getORM()->where("order_num" , $order)->order('time DESC')->fetchall();
        }

        public function addWarningFlag($order_num , $barcode , $flag) {
            return $this->getORM()->where("order_num" , $order_num)->where("barcode" , $barcode)->update(array('iswarning' => $flag));
        }

        public function updateCountInfo($barcode , $order , $count) {
            return $this->getORM()->where("order_num" , $order)->where("barcode" , $barcode)->update(array('count' => $count));
        }

    }
    