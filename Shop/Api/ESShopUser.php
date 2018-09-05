<?php

    /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESShopUser extends PhalApi_Api {

        public function getRules() {
            return array(
                'getUserList' => array(
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
        public function getUserList() {
            //获取商店信息
            $Domain_ShopInfo = new Domain_Manage();
            return $Domain_ShopInfo->getShopUserList($this);
        }

    }
    