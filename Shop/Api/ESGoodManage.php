<?php

  /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESGoodManage extends PhalApi_Api {

        public function getRules() {
            return array(
                'setGoodInfo'    => array(
                    'goodid'  => array(
                        'name'    => 'goodid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品id') ,
                    'goodname'  => array(
                        'name'    => 'name' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品名称') ,
                    'cost'  => array(
                        'name'    => 'cost' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品进价') ,
                    'lowprice'  => array(
                        'name'    => 'lowprice' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品最低价') ,
                    'price'  => array(
                        'name'    => 'price' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品价格') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
            );
        }

        /**
         * 维护商品信息
         * 
         */
        public function setGoodInfo() {
            $Domain_Goods = new Domain_Goods();
            return $Domain_Goods->getGoodManage($this);
        }

    }
    