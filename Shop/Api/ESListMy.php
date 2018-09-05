<?php

    /**
     * 我的接口服务类
     *

     */
    class Api_ESListMy extends PhalApi_Api {

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
         * 获取我的管理根列表(使用中)
         * 20160727
         */
        public function getRootList() {
            $RootList = new Domain_ListManage();
            return $RootList->getMyRootList($this);
        }

        /**
         * 获取我的管理二级列表(使用中)
         * 20160727
         */
        public function getOtherList() {
            $OtherList = new Domain_ListManage();
            return $OtherList->getMyOtherList($this);
        }

    }
    