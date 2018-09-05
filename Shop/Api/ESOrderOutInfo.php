<?php

    /**
     * 商品入库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESOrderOutInfo extends PhalApi_Api {

        public function getRules() {
            return array(
                'changeInfo' => array(
                    'barcode'  => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'number'   => array(
                        'name'    => 'number' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '数量') ,
                    'price'    => array(
                        'name'    => 'price' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '单价') ,
                    'shopid'   => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'discount' => array(
                        'name'    => 'discount' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '优惠') ,
                    'order'    => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'other'    => array(
                        'name' => 'other' ,
                        'type' => 'string' ,
                        'desc' => '其他说明') ,
                    'reqid'    => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 修改订单详情(使用,1.0,OK)
         * 20160722 1.0
         * @desc 修改订单详情
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
        public function changeInfo() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->changeoutorderinfo($this);
        }

    }
    