<?php

    class Model_Orders extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'orders';
        }

        /**
         * 插入order数据
         */
        public function addOrder($order_number , $storeid , $type , $shopid , $responser) {
            return $this->getORM()
                            ->insert(array(
                                'seralordernum' => $order_number ,
                                'storeid'       => $storeid ,
                                'shopid'        => $shopid ,
                                'states'        => 1 ,
                                'ordertype'     => $type ,
                                'responser'     => $responser ,
                                'time'          => time()
            ));
        }

        /**
         * 插入order数据
         */
        public function updateInto($order_number , $intoId) {
            return $this->getORM()->where('seralordernum' , $order_number)->update(array('storeinto' => $intoId));
        }

        /**
         *  查询表数据
         */
        public function searchOrderWithSeralOrderNum($order_number) {
            return $this->getORM()->select("seralordernum")->where("seralordernum" , $order_number)->fetch();
        }

        /**
         * 改变订单状态
         */
        public function changeOrderStates($order , $states) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('states' => $states));
        }

        /**
         * 设置订单签单人
         */
        public function setResponser($order , $id) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('responser' => $id , 'states' => 2));
        }

        /**
         * 查询订单
         */
        public function getOrderInfo($order) {
            return $this->getORM()->where('seralordernum' , $order)->fetchrow();
        }

        public function updateCount($order , $count , $expense , $moneyin , $moneyout) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('count' => $count , 'expense' => $expense , 'moneyin' => $moneyin , 'moneyout' => $moneyout));
        }

        public function updateMoneyIn($order , $money) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('moneyin' => $money));
        }

        public function updateMoneyOut($order , $money) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('moneyout' => $money));
        }

        public function updateMoney($order , $count , $expense , $moneyin , $moneyout) {
            return $this->getORM()->where('seralordernum' , $order)->update(array('count' => $count , 'expense' => $expense , 'moneyin' => $moneyin , 'moneyout' => $moneyout));
        }

    }
    