<?php

    /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESChgPermit extends PhalApi_Api {

        public function getRules() {
            return array(
                'makePermitOn'  => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '店铺号') ,
                    'id'     => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '权限id') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
                'makePermitOff' => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '店铺号') ,
                    'id'     => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '权限id') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
            );
        }

        /**
         * 商品上架
         * 20170725
         * @desc storeid 传入all代表所有的仓库
         * 
         */
        public function makePermitOn() {
            $Domain_Goods = new Domain_ESChgPermit();
            return $Domain_Goods->makePermitOn($this);
        }

        /**
         * 商品下架
         * 20170725
         * @desc storeid 传入all代表所有的仓库
         * 
         */
        public function makePermitOff() {
            $Domain_Goods = new Domain_ESChgPermit();
            return $Domain_Goods->makePermitOff($this);
        }

    }
    