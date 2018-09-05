<?php

    class Model_ESDayAcc extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'acc_day';
        }

        /**
         *  管理数据添加
         */
        public function addDayAcc($shopid , $userid , $account , $date) {
            return $this->getORM()
                            ->insert(array(
                                "shopid"  => $shopid ,
                                "userid"  => $userid ,
                                "account" => $account ,
                                "time"    => time() ,
                                "date"    => $date ,
            ));
        }

        public function getAcc($shopid , $userid , $tdate) {
            return $this->getORM()->where("shopid" , $shopid)->where("userid" , $userid)->where("date" , $tdate)->fetchall();
        }

        public function getAccOne($shopid , $userid , $tdate) {
            return $this->getORM()->where("shopid" , $shopid)->where("userid" , $userid)->where("date" , $tdate)->fetchrow();
        }

    }
    