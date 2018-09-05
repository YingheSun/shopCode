<?php

    /**
     * 商品销售接口服务类
     *
     * @author: YHS 20160603
     * 
     */
    class Api_ESConfirmOrder extends PhalApi_Api {

        public function getRules() {
            return array(
                'getInOrder'  => array(
                    'order' => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'reqid' => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getOutOrder' => array(
                    'order' => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'reqid' => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getChgOrder'   => array(
                    'order' => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'reqid' => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 获取入库订单详情(使用,1.0,OK)
         * 20160722 1.0
         * @desc 获取订单详情
         * @return string id 编号(和scanIn使用同一个解析类)
         * @return string barcode 条码
         * @return string number 数量
         * @return string price 单品价格
         * @return string count 单品总计价格
         * @return string seral_id 订单号
         * @return string goodname 商品名称
         * @return string other 其他附言
         * @return string time 时间
         */
        public function getInOrder() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->getOrder($this);
        }

        /**
         * 获取出库订单详情(使用,1.0,OK)
         * 20160722 1.0
         * @desc 获取订单详情
         * @return string id 编号(和scanOut使用同一个解析类)
         * @return string barcode 条码
         * @return string number 数量
         * @return string count 价格
         * @return string order_num 订单号
         * @return string other 其他附言
         * @return string discount 减价
         * @return string shopid 商店id
         * @return string storeid 库房id
         * @return string goodname 商品名称
         * @return string time 时间
         * @return string iswarning 报警（库存不报警：NO，报警为负数即表示低于库存警戒值数量）
         */
        public function getOutOrder() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->getoutOrder($this);
        }

        /**
         * 获取转库订单详情(使用,1.0,OK)
         * 20160722 1.0
         * @desc 获取订单详情
         * @return string id 编号(和scanOut使用同一个解析类)
         * @return string barcode 条码
         * @return string number 数量
         * @return string count 价格
         * @return string order_num 订单号
         * @return string other 其他附言
         * @return string discount 减价
         * @return string shopid 商店id
         * @return string storeid 库房id
         * @return string goodname 商品名称
         * @return string time 时间
         * @return string iswarning 报警（库存不报警：NO，报警为负数即表示低于库存警戒值数量）
         */
        public function getChgOrder() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->getChgOrderInfo($this);
        }

    }
    