<?php

    class Model_Inflow extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'inflow';
        }

        public function insertflow($data , $name , $other , $price) {
            return $this->getORM()
                            ->insert(array(
                                "barcode"  => $data->barcode ,
                                "number"   => $data->number ,
                                "price"    => $price ,
                                "seral_id" => $data->order ,
                                "other"    => $other ,
                                "time"     => time() ,
                                "goodname" => $name
            )); 
        }

        public function insertFlowWithCode($barcode , $number , $order , $other , $name) {
            return $this->getORM()
                            ->insert(array(
                                "barcode"  => $barcode ,
                                "number"   => $number ,
                                "seral_id" => $order ,
                                "other"    => $other ,
                                "time"     => time() ,
                                "goodname" => $name
            ));
        }

        public function searchGoodinorder($barcode , $order) {
            return $this->getORM()->select("barcode")->where("barcode" , $barcode)->where("seral_id" , $order)->fetchrow();
        }

        public function increaseGoodinorder($data) {
            return $this->getORM()->where("barcode" , $data->barcode)->where("seral_id" , $data->order)->update(array('number' => new NotORM_Literal("number + $data->number") , 'time' => time()));
        }

        public function addGoodToOrder($barcode , $order , $number) {
            $this->getORM()->where("barcode" , $barcode)->where("seral_id" , $order)->update(array('number' => new NotORM_Literal("number + $number") , 'time' => time()));
        }

        public function getOrderInfo($order) {
            return $this->getORM()->where("seral_id" , $order)->order('time DESC')->fetchall();
        }

        public function updateOrderInfo($data) {
            return $this->getORM()->where("barcode" , $data->barcode)->where("seral_id" , $data->order)->update(array('number' => $data->number , 'time' => time() , 'price' => $data->price , 'other' => $data->other , 'count' => $data->count , 'goodname' => $data->goodname));
        }

        public function updateCountInfo($barcode , $order , $count) {
            return $this->getORM()->where("barcode" , $barcode)->where("seral_id" , $order)->update(array('time' => time() , 'count' => $count));
        }

        public function getOrderInflowInfo($order) {
            //return $this->getORM()->where("seral_id" , $order)->order('time DESC')->limit(5)->fetchall();
            return $this->getORM()->where("seral_id" , $order)->order('time DESC')->fetchall();
        }

    }
    