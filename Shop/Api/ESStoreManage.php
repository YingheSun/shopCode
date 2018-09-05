<?php

    /**
     * 库房管理接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESStoreManage extends PhalApi_Api {

        public function getRules() {
            return array(
                'addStore'        => array(
                    'shopid'       => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'storeName'    => array(
                        'name'    => 'storename' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房名称') ,
                    'reqid'        => array(
                        'name'    => 'reqid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
//                    'storeaddress' => array(
//                        'name' => 'storeaddress' ,
//                        'type' => 'string' ,
//                        'desc' => '库房地址') ,
//                    'storedetail'  => array(
//                        'name' => 'storedetail' ,
//                        'type' => 'string' ,
//                        'desc' => '库房简介') ,
                ) ,
                'abendStore'      => array(
                    'storeId' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房id') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
                'reuseStore'      => array(
                    'storeId' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房id') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
                'changeStoreInfo' => array(
                    'storeId'   => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房id') ,
                    'storeName' => array(
                        'name'    => 'storename' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房名称') ,
                    'kindsnum'  => array(
                        'name'    => 'kindsnum' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '共有多少种货物') ,
                    'numbers'   => array(
                        'name'    => 'numbers' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '共有货物数量') ,
                    'reqid'     => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id') ,
                ) ,
                'getStoreList'    => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'state'  => array(
                        'name'    => 'state' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '状态') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
                'getStoreInfo'    => array(
                    'storeId' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '库房id') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人id')
                ) ,
            );
        }

        /**
         * 添加商店库房(使用中)
         * 20160722
         */
        public function addStore() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->addStore($this);
        }

        /**
         * 作废商店库房(使用中)
         * 20160722
         * @desc code:161 不能作废库房 作废商店库房
         * @return string id 库房编号
         * @return string stroe 库房名称
         * @return string numbers 所含商品数量
         * @return string kindsnum 所含商品种类
         * @return string owner 所有人
         * @return string shopid 商店id
         * @return string state 状态
         * @return string extra2 拓展属性
         */
        public function abendStore() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->abendStore($this);
        }

        /**
         * 作废商店库房(使用中)
         * 20160722
         * @desc code:161 不能作废库房 作废商店库房
         * @return string id 库房编号
         * @return string stroe 库房名称
         * @return string numbers 所含商品数量
         * @return string kindsnum 所含商品种类
         * @return string owner 所有人
         * @return string shopid 商店id
         * @return string state 状态
         * @return string extra2 拓展属性
         */
        public function reuseStore() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->reuseStore($this);
        }

        /**
         * 修改商店库房信息(使用中)
         * 20160722
         */
        public function changeStoreInfo() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->changeStoreInfo($this);
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
            return $Domain_Store->getShopStoreListWithType($this);
        }

        /**
         * 获取商店库房信息(使用中)
         * 20160722
         */
        public function getStoreInfo() {
            $Domain_Store = new Domain_Manage();
            return $Domain_Store->getStoreInfo($this);
        }

    }
    