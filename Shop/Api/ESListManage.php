<?php

    /**
     * 管理者接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESListManage extends PhalApi_Api {

        public function getRules() {
            return array(
                'getRootList'  => array(
                    'shopid' => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'reqid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求人id')
                ) ,
                'getOtherList' => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'reqType' => array(
                        'name'    => 'type' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求类别') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求人id')
                ) ,
            );
        }

        /**
         * 获取商店管理根列表(使用中)
         * 20160727
         */
        public function getRootList() {
            $RootList = new Domain_ListManage();
            return $RootList->getRootList($this);
        }

        /**
         * 获取商店管理二级列表(使用中)
         * 20160727
         */
        public function getOtherList() {
            $OtherList = new Domain_ListManage();
            return $OtherList->getOtherList($this);
        }

    }
    