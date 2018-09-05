<?php

    /**
     * 管理商品类别接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_ESTypeManage extends PhalApi_Api {

        public function getRules() {
            return array(
                'getTypeList' => array(
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
                'addType'         => array(
                    'shopid'   => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店id') ,
                    'typename' => array(
                        'name'    => 'typename' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '类别名') ,
                    'reqid'    => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '负责人') ,
                )
            );
        }

        public function getTypeList() {
            $TypeList = new Model_Type();
            return $TypeList->getTypeList($this->shopid);
        }

        public function addType() {
            $addType  = new Model_Type();
            $addType->addType($this);
            $TypeList = new Model_Type();
            return $TypeList->getTypeList($this->shopid);
        }

    }
    