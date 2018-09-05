<?php

    /**
     * 商品入库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESOrderInInfo extends PhalApi_Api {

        public function getRules() {
            return array(
                'changeInfo' => array(
                    'barcode'  => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'min'     => 13 ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'number'   => array(
                        'name'    => 'number' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '数量') ,
                    'price'    => array(
                        'name' => 'price' ,
                        'type' => 'string' ,
                        'desc' => '单价') ,
                    'order'    => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'other'    => array(
                        'name' => 'other' ,
                        'type' => 'string' ,
                        'desc' => '其他说明') ,
                    'count'    => array(
                        'name' => 'count' ,
                        'type' => 'string' ,
                        'desc' => '总价') ,
                    'goodname' => array(
                        'name' => 'goodname' ,
                        'type' => 'string' ,
                        'desc' => '品名') ,
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
         * @return string total 总钱数
         * @return string linecount 总行数
         * @return string other1 其他1
         * @return string other2 其他2
         * @return list retlist
         * @return string id 编号
         * @return string barcode 条码
         * @return string number 数量
         * @return string price 单品价格
         * @return string count 单品总计价格
         * @return string seral_id 订单号
         * @return string goodname 商品名称
         * @return string other 其他附言
         * @return string time 时间
         * @return list retlist
         */
        public function changeInfo() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->changeorderinfo($this);
        }

    }
    