<?php

    /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESGoodTypeList extends PhalApi_Api {

        public function getRules() {
            return array(
                'getGoodTypeList'    => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'typeid'  => array(
                        'name'    => 'typeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '类型id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
            );
        }

        /**
         * 获取已维护商品列表
         * 20170725
         * @desc storeid 传入all代表所有的仓库
         * 
         */
        public function getGoodTypeList() {
            $Domain_Goods = new Domain_Goods();
            return $Domain_Goods->getGoodTypeList($this);
        }

    }
    