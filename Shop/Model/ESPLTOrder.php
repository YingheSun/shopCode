<?php

    class Model_ESPLTOrder extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'orders';
        }

        /**
         *  查询表数据
         */
        public function getOrderList($shopid , $user) {
            return $this->getORM()->where("states" , "1")->where("shopid" , $shopid)->where("responser" , $user)->fetchall();
        }

        /**
         *  查询表数据
         */
        public function getOrderListWithType($shopid , $user , $type) {
            return $this->getORM()->where("states" , "1")->where("shopid" , $shopid)->where("responser" , $user)->where("ordertype" , $type)->fetchall();
        }

        /**
         *  查询表数据
         */
        public function getAllOrderList($shopid , $user) {
            return $this->getORM()->where("states" , "3")->where("shopid" , $shopid)->where("responser" , $user)->fetchall();
        }

        /**
         *  修改订单状态
         */
        public function UDOrderClose($shopid , $user) {
            return $this->getORM()->where("states" , "1")->where("shopid" , $shopid)->where("responser" , $user)->update(array("states" => "失效"));
        }

        /**
         *  修改订单状态
         */
        public function TDOrderClose($shopid , $user) {
            return $this->getORM()->where("states" , "3")->where("shopid" , $shopid)->where("responser" , $user)->update(array("states" => "已结账"));
        }

    }
    