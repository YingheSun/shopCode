<?php

    /**
     * 未完成订单接口服务类
     *
     * @author: YHS 20160901
     * 
     */
    class Api_ESPLTGoodInfo extends PhalApi_Api {

        public function getRules() {
            return array(
                'getInfo' => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'barcode' => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'min'     => 13 ,
                        'require' => true ,
                        'desc'    => '条码') ,
                    'reqid'   => array(
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
        public function getInfo() {
            $goodInfo = new Domain_Goods();
            return $goodInfo->getGoodInfo($this);
        }

    }
    