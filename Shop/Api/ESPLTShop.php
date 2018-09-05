<?php

    /**
     * 今日订单金额汇总接口服务类
     *
     * @author: YHS 20160901
     * 
     */
    class Api_ESPLTShop extends PhalApi_Api {

        public function getRules() {
            return array(
                'getTDCount' => array(
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
        public function getTDCount() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getTDOrderAcc($this);
        }

    }
    