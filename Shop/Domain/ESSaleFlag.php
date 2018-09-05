<?php

    class Domain_ESSaleFlag {

        public function getGoodFlagSale($data) {
            $getOrder = new Model_Goods();
            $getOrder->updateGoodSaleState($data->goodid);
            $getList  = new Model_Goods();
            return $getList->getGoodInfo($data->goodid);
        }

        public function getGoodFlagOffSale($data) {
            $getOrder = new Model_Goods();
            $getOrder->updateGoodOffSaleState($data->goodid);
            $getList  = new Model_Goods();
            return $getList->getGoodInfo($data->goodid);
        }

    }
    