<?php

    /**
     * 未完成订单接口服务类
     *
     * @author: YHS 20160901
     * 
     */
    class Api_ESPLTOrder extends PhalApi_Api {

        public function getRules() {
            return array(
                'getAllUDOrder' => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getUDROrder'   => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getUDCOrder'   => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getUDZOrder'   => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 获取未完成订单
         * 20160901
         */
        public function getAllUDOrder() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getAllUDorder($this);
        }

        /**
         * 获取未完成入库订单
         * 20160901
         */
        public function getUDROrder() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getUDROrder($this);
        }

        /**
         * 获取未完成出库订单
         * 20160901
         */
        public function getUDCOrder() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getUDCOrder($this);
        }

        /**
         * 获取未完成转库订单
         * 20160901
         */
        public function getUDZOrder() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getUDZOrder($this);
        }

    }
    