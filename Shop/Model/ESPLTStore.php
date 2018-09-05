<?php

    class Model_ESPLTStore extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'storage';
        }

        public function getWar($id) {
//            return $this->getORM()->where('storeid' , $id)->where('number < ? AND warningine AS A' , 'A')->fetchall();
            $sql    = 'SELECT a.number, a.warningline, b.stroe, c.goods_name from MRP_storage AS a LEFT JOIN MRP_store AS b ON a.storeid = b.id LEFT JOIN MRP_goods AS c ON a.goodid = c.id WHERE a.storeid = :storeid AND a.number < a.warningline';
            $params = array(':storeid' => $id);
            return $this->getORM()->queryAll($sql , $params);
        }

    }
    