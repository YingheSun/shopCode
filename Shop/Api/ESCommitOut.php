<?php

    /**
     * 商品入库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESCommitOut extends PhalApi_Api {

        public function getRules() {
            return array(
                'commitOrder' => array(
                    'order'   => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '店铺号') ,
                    'userid'  => array(
                        'name'    => 'userid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '用户id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                    'count'   => array(
                        'name' => 'count' ,
                        'type' => 'string' ,
                        'require' => true ,
                        'desc' => '总价') ,
                    'expense' => array(
                        'name' => 'expense' ,
                        'type' => 'string' ,
                        'require' => true ,
                        'desc' => '支出') ,
                    'moneyin' => array(
                        'name' => 'moneyin' ,
                        'type' => 'string' ,
                        'require' => true ,
                        'desc' => '收钱') ,
                    'moneyout' => array(
                        'name' => 'moneyout' ,
                        'type' => 'string' ,
                        'require' => true ,
                        'desc' => '支出钱') ,
                ) ,
            );
        }

        /**
         * 提交订单(使用,1.0,OK)
         * 20160722 1.0
         * @desc code: 303 已经被提交过了 
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
        public function commitOrder() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->commitSellingOrder($this);
        }

    }
    