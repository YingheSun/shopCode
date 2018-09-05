<?php

    class Domain_Goods {

        public function goodsList($data) {
            if ($data->storeid == "all") {
                return $this->getAllGoodList($data);
            } else {
                $Model_Goods = new Model_Goods();
                return $Model_Goods->getDoneShopGoodsList($data->shopid , $data->page);
            }
        }

        public function allGoodsList($data) {
            if ($data->storeid == "all") {
                return $this->getAllGoodList($data);
            } else {
                $Model_Goods = new Model_Goods();
                return $Model_Goods->getGoodsList($data->shopid , $data->storeid , $data->page);
            }
        }

        public function getAllGoodList($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->getShopGoodsList($data->shopid , 1);
        }

        public function getGoodTypeList($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->getGoodTypeList($data->shopid , $data->typeid);
        }

        public function getGoodManage($data) {
            $Model_Goods = new Model_Goods();
            $Model_Goods->updateGoodInfo($data);
            $getList     = new Model_Goods();
            return $getList->getGoodInfo($data->goodid);
        }

        public function waitGoodsList($data) {
            if ($data->storeid == "all") {
                return $this->getShopWaitGoodsList($data);
            } else {
                $Model_Goods = new Model_Goods();
                return $Model_Goods->getWaitGoodsList($data->shopid , $data->storeid , $data->page);
            }
        }

        public function waitingGoodsList($data) {
            $Model_Goods = new Model_UGoods();
            return $Model_Goods->getWaitGoodsList($data->shopid);
        }
        
        public function waitingGoodManage($data) {
            $Model_Goods = new Model_UGoods();
            return $Model_Goods->getWaitGoodsList($data->shopid);
        }

        public function getShopWaitGoodsList($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->getShopWaitGoodsList($data->shopid , $data->page);
        }

        public function getDoneShopGoodsList($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->getDoneShopGoodsList($data->shopid , $data->page);
        }

        public function doneGoodsList($data) {
            if ($data->storeid == "all") {
                return $this->getDoneShopGoodsList($data);
            } else {
                $Model_Goods = new Model_Goods();
                return $Model_Goods->getDoneGoodsList($data->shopid , $data->storeid , $data->page);
            }
        }

        public function makeWarningLine($data) {
            $Model_GoodsWarning = new Model_Storage();
            return $Model_GoodsWarning->updateWarningLine($data->storeid , $data->warningLine , $data->goodid);
        }

        public function makeGoodInfo($data) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->updateGoodInfo($data);
        }

        public function makeGoodOnSale($goodid) {
            $Model_Goods = new Model_Goods();
            $goodInfo    = $Model_Goods->getGoodInfo($goodid);
            if ($goodInfo['managetype'] == "done") {
                $Model_GoodsOnSale = new Model_Goods();
                $goodInfo          = $Model_GoodsOnSale->updateGoodSaleState($goodid);
            }
        }

        public function makeGoodOffSale($goodid) {
            $Model_Goods = new Model_Goods();
            $goodInfo    = $Model_Goods->getGoodInfo($goodid);
            if ($goodInfo['managetype'] == "done") {
                $Model_GoodsOnSale = new Model_Goods();
                $goodInfo          = $Model_GoodsOnSale->updateGoodOffSaleState($goodid);
            }
        }

        public function getAllManagedNewGoods($userid) {
            $Model_Goods = new Model_Goods();
            return $Model_Goods->getAllManagedNewGoods();
        }

        public function getGoodInfo($data) {
            $Model_Goods = new Model_Goods();
            $info        = $Model_Goods->searchShopGood($data->barcode , $data->shopid);
            if (!$info) {
                throw new PhalApi_Exception_BadRequest(T('no good info') , 180);
            }
            return $info;
        }

    }
    