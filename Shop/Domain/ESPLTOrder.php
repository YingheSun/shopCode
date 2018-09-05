<?php

    class Domain_ESPLTOrder {

        public function getAllUDorder($data) {
            $getOrder = new Model_ESPLTOrder();
            return $getOrder->getOrderList($data->shopid , $data->reqid);
        }

        public function getUDROrder($data) {
            $getOrder = new Model_ESPLTOrder();
            return $getOrder->getOrderListWithType($data->shopid , $data->reqid , "1");
        }

        public function getUDCOrder($data) {
            $getOrder = new Model_ESPLTOrder();
            return $getOrder->getOrderListWithType($data->shopid , $data->reqid , "2");
        }

        public function getUDZOrder($data) {
            $getOrder = new Model_ESPLTOrder();
            return $getOrder->getOrderListWithType($data->shopid , $data->reqid , "3");
        }

        public function getTDorders($data) {
            $getOrder = new Model_ESPLTOrder();
            return $getOrder->getAllOrderList($data->shopid , $data->reqid);
        }

        public function getTDOrderAcc($data) {
            $allOrder    = $this->getTDorders($data);
            $orderNum    = 0;
            $orderCNum   = 0;
            $orderRNum   = 0;
            $orderZNum   = 0;
            $countAll    = 0;
            $expAll      = 0;
            $moneyInAll  = 0;
            $moneyOutAll = 0;
            $UDAllOrder  = 0;
            $UDCAllOrder = 0;
            $UDRAllOrder = 0;
            $UDZAllORder = 0;
            foreach ((array) $allOrder as $key => $val) {
                $orderNum ++;
                if (intval($allOrder[$key]['ordertype']) == 1) {
                    $orderRNum++;
                } else if (intval($allOrder[$key]['ordertype']) == 2) {
                    $orderCNum++;
                } else if (intval($allOrder[$key]['ordertype']) == 3) {
                    $orderZNum++;
                }
                $countAll    = $countAll + $allOrder[$key]['count'];
                $expAll      = $expAll + $allOrder[$key]['expense'];
                $moneyInAll  = $moneyInAll + $allOrder[$key]['moneyin'];
                $moneyOutAll = $moneyOutAll + $allOrder[$key]['moneyout'];
            }
            $allUDOrder = $this->getAllUDorder($data);
            foreach ((array) $allUDOrder as $key => $val) {
                $UDAllOrder ++;
                if (intval($allUDOrder[$key]['ordertype']) == 1) {
                    $UDRAllOrder++;
                } else if (intval($allUDOrder[$key]['ordertype']) == 2) {
                    $UDCAllOrder++;
                } else if (intval($allUDOrder[$key]['ordertype']) == 3) {
                    $UDZAllORder++;
                }
            }
            $Model_User = new Model_User();
            $userinfo   = $Model_User->getuserInfoByIdOne($data->reqid);
            $Model_Shop = new Model_Shop();
            $shopInfo   = $Model_Shop->getShopInfoByIdOne($data->shopid);
            $retCount   = array('shopName' => $shopInfo['shop_name'] , 'userName' => $userinfo['user_name'] , 'countAll' => $countAll , 'expAll' => $expAll , 'moneyInAll' => $moneyInAll , 'moneyOutAll' => $moneyOutAll , 'orderNum' => $orderNum , 'orderCNum' => $orderCNum , 'orderRNum' => $orderRNum , 'orderZNum' => $orderZNum , 'UDAllOrder' => $UDAllOrder , 'UDCAllOrder' => $UDCAllOrder , 'UDRAllOrder' => $UDRAllOrder , 'UDZAllORder' => $UDZAllORder);
            $retInfo    = array($retCount);
            return $retInfo;
        }

    }
    