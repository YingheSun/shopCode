<?php

    /**
     * 未完成订单接口服务类
     *
     * @author: YHS 20160901
     * 
     */
    class Api_ESPLTAcc extends PhalApi_Api {

        public function getRules() {
            return array(
                'closeAccount' => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'account' => array(
                        'name'    => 'account' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '结账金额') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'getAccount'   => array(
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
         * 日结账
         * 20160901
         */
        public function closeAccount() {
            $closeAccount = new Domain_ESDayAcc();
            return $closeAccount->makeDayAccClose($this);
        }

        /**
         * 获取日结账数据
         * 20160901
         */
        public function getAccount() {
            $getOrder = new Domain_ESPLTOrder();
            return $getOrder->getTDOrderAcc($this);
        }

    }
    