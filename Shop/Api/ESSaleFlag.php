<?php

   /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESSaleFlag extends PhalApi_Api {

        public function getRules() {
            return array(
                'makeGoodOnSale'    => array(
                    'goodid'  => array(
                        'name'    => 'goodid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
                'makeGoodOffSale'    => array(
                    'goodid'  => array(
                        'name'    => 'goodid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品id') ,
                    'reqid'   => array(
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
        public function makeGoodOnSale() {
            $Domain_Goods = new Domain_ESSaleFlag();
            return $Domain_Goods->getGoodFlagSale($this);
        }
        
        /**
         * 商品下架
         * 20170725
         * @desc storeid 传入all代表所有的仓库
         * 
         */
        public function makeGoodOffSale() {
            $Domain_Goods = new Domain_ESSaleFlag();
            return $Domain_Goods->getGoodFlagOffSale($this);
        }

    }
    