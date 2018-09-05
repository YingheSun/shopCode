<?php

    /**
     * 未完成订单接口服务类
     *
     * @author: YHS 20160901
     * 
     */
    class Api_ESPLTGWar extends PhalApi_Api {

        public function getRules() {
            return array(
                'getAllWar' => array(
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
        public function getAllWar() {
            $getAllWar = new Domain_ESPLTGWar();
            return $getAllWar->getAllWar($this);
        }

    }
    