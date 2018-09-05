<?php

    /**
     * 订单接口服务类
     *
     * @author: YHS 20160603
     * 
     */
    class Api_ESOrder extends PhalApi_Api {

        public function getRules() {
            return array(
                //创建订单
                'createInOrder'    => array(
                    'storeid' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '库房号') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'createOutOrder'   => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'chgStoreOrder' => array(
                    'storeid'   => array(
                        'name'    => 'storeid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '转出库房号') ,
                    'storeinto' => array(
                        'name'    => 'changeto' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '转入库房号') ,
                    'shopid'    => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'     => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) 
            );
        }

        /**
         * 创建入库订单(使用中,1.0,OK)
         * 20160620
         * 20160722 1.0
         * 20160727 修改+reqid
         * 20160826 修改
         * @desc code: 301 没有这个商店
         * @return string data 订单号
         */
        public function createInOrder() {
            $order_number       = date('Ymd') . substr(implode(NULL , array_map('ord' , str_split(substr(uniqid() , 7 , 13) , 1))) , 0 , 8);
            $order              = "DDR$order_number";
            $Domain_CreateOrder = new Domain_Order();
            return $Domain_CreateOrder->CreateInOrder($order , $this);
        }

        /**
         * 创建出库订单(使用中,1.0,OK)
         * 20160620
         * 20160722 1.0
         * 20160727 修改+reqid
         * 20160826 修改
         * @desc code: 301 没有这个商店
         * @return string data 订单号(和createInOrder使用同一个解析类)
         */
        public function createOutOrder() {
            $order_number       = date('Ymd') . substr(implode(NULL , array_map('ord' , str_split(substr(uniqid() , 7 , 13) , 1))) , 0 , 8);
            $order              = "DDC$order_number";
            $Domain_CreateOrder = new Domain_Order();
            return $Domain_CreateOrder->CreateOutOrder($order , $this);
        }

        /**
         * 创建转库订单(使用中,1.0,OK)
         * 20160727 
         * 20160826 修改
         * @desc code: 301 没有这个商店
         * @return string data 订单号(和createInOrder使用同一个解析类)
         */
        public function chgStoreOrder() {
            $order_number       = date('Ymd') . substr(implode(NULL , array_map('ord' , str_split(substr(uniqid() , 7 , 13) , 1))) , 0 , 8);
            $order              = "DDZ$order_number";
            $Domain_CreateOrder = new Domain_Order();
            return $Domain_CreateOrder->CreateChangeStoreOrder($order , $this);
        }

    }
    