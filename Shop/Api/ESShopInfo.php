<?php

    /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESShopInfo extends PhalApi_Api {

        public function getRules() {
            return array(
                'getShopInfo' => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人') ,
                ) ,
                'chgShopInfo' => array(
                    'shopid'       => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'shop_name'    => array(
                        'name'    => 'shopname' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '名称') ,
                    'shop_address' => array(
                        'name'    => 'address' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '地址') ,
                    'callphone'    => array(
                        'name'    => 'callphone' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '电话') ,
                    'telephone'    => array(
                        'name'    => 'telephone' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '手机') ,
                    'introduce'    => array(
                        'name'    => 'introduce' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '简介') ,
                    'weixin'       => array(
                        'name'    => 'weixin' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '微信') ,
                    'reqid'        => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '修改人') ,
                ) ,
            );
        }

        /**
         * 获取商店基本信息(使用中)
         * 20160720
         * 20160801
         * @desc 获取商店信息
         * @return string id 编号
         * @return string shop_name 名称
         * @return string shop_address 地址
         * @return string callphone 电话
         * @return string telephone 手机
         * @return string introduce 简介
         * @return string weixin 微信号
         * @return string gpsx gps
         * @return string gpsy gps
         * @return string owner 所有者
         */
        public function getShopInfo() {
            //获取商店信息
            $Domain_ShopInfo = new Domain_Manage();
            return $Domain_ShopInfo->getShopInfo($this);
        }

        /**
         * 修改商店信息(使用中)
         * 20160720
         * 20160801
         * @desc 修改商店信息
         * @return string changeline 修改行数
         */
        public function chgShopInfo() {
            $Domain_ShopChange = new Domain_Manage();
            $rs                = $Domain_ShopChange->changeShopInfo($this);
            $a[]               = array("changeline" => $rs);
            return $a;
        }

    }
    