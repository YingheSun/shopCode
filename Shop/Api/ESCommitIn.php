<?php

    /**
     * 商品入库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESCommitIn extends PhalApi_Api {

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
                    'storeid' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '库房号') ,
                    'uid'     => array(
                        'name'    => 'userid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '用户id') ,
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
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 提交订单(使用,1.0,OK)
         * 20160622
         * 20160722 1.0
         * @desc code: 112 已经被提交过了 提交订单接口
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
        public function commitOrder() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->commitOrder($this);
        }

    }
    