<?php

    /**
     * 库房选择接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESStoreSel extends PhalApi_Api {

        public function getRules() {
            return array(
                'getStoreList' => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
                'extraStoreList' => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'outstoreid' => array(
                        'name'    => 'outstoreid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '出库库房id') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
            );
        }

        /**
         * 获取商店库房列表(使用中)
         * 20160722
         * @desc 获取商店库房列表
         * @return string id 库房编号
         * @return string stroe 库房名称
         * @return string numbers 所含商品数量
         * @return string kindsnum 所含商品种类
         * @return string owner 所有人
         * @return string shopid 商店id
         * @return string state 状态
         * @return string extra2 拓展属性
         */
        public function getStoreList() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->getShopUsingStore($this);
        }
        
        /**
         * 获取商店转库入库库房列表(使用中)
         * 20160722
         * @desc 获取商店转库入库库房列表
         * @return string id 库房编号
         * @return string stroe 库房名称
         * @return string numbers 所含商品数量
         * @return string kindsnum 所含商品种类
         * @return string owner 所有人
         * @return string shopid 商店id
         * @return string state 状态
         * @return string extra2 拓展属性
         */
        public function extraStoreList() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->getShopOtherStore($this);
        }

    }
    