<?php

    class Domain_ESWaitGood {

        public function getWaitGoodInfo($data) {
            $getList = new Model_UGoods();
            return $getList->getGoodInfo($data->goodid);
        }

        public function setWaitGoodInfo($data) {
            //更新商品的信息
            $Model_Goods = new Model_UGoods();
            $Model_Goods->updateGoodInfo($data);
            //将商品转到goods表
            $trans       = new Model_UGoods();
            $trans->makeInfoToGoods($data->goodid);
            //获取商品信息
            $getList     = new Model_UGoods();
            $result      = $getList->getGoodInfo($data->goodid);
            //删除商品的记录
            $dropgood    = new Model_UGoods();
            $dropgood->dropInfoWithId($data->goodid);
            return $result;
        }

    }
    