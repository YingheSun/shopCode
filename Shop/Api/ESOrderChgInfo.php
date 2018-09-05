<?php

    /**
     * 商品转库修改接口服务类
     */
    class Api_StoreChange extends PhalApi_Api {

        public function getRules() {
            return array(
                'chgOrderInfo' => array(
                    'barcode' => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'number'  => array(
                        'name'    => 'number' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '数量') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'storeid' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '仓库编号') ,
                    'order'   => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'other'   => array(
                        'name' => 'other' ,
                        'type' => 'string' ,
                        'desc' => '其他说明') ,
                    'reqid'   => array(
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
         * @return string id 编号(和scanIn使用同一个解析类)

         */
        public function chgOrderInfo() {
            $Domain_Store = new Domain_Order();
            return $Domain_Store->changeoutorderinfo($this);
        }

    }
    