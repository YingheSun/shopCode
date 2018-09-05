<?php

    class Domain_ESDayAcc {

        public function makeDayAccClose($data) {
            //所有的未完成订单全部失效
            $closeUDOrder = new Model_ESPLTOrder();
            $closeUDOrder->UDOrderClose($data->shopid , $data->reqid);
            //所有的完成订单变成结账完的状态
            $closeTDOrder = new Model_ESPLTOrder();
            $closeTDOrder->TDOrderClose($data->shopid , $data->reqid);
            //将结账信息传到表中
            $dayAcc       = new Model_ESDayAcc();
            $time         = time();
            $tdate        = date("y-m-d" , $time);
            $dayAcc->addDayAcc($data->shopid , $data->reqid , $data->account , $tdate);
            $getAcc       = new Model_ESDayAcc();
            return $getAcc->getAcc($data->shopid , $data->reqid , $tdate);
        }

    }
    