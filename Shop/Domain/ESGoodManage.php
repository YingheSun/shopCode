<?php

    class Domain_ESGoodManage {

        public function getGoodManage($data) {
            $getOrder = new Model_Goods();
            $getOrder->updateGoodSaleState($data->goodid);
            $getList  = new Model_Goods();
            return $getList->getGoodInfo($data->goodid);
        }

    }
    