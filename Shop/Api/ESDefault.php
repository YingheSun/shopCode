<?php

    /**
     * 默认接口服务类
     *
     * @author: YHS 20160603
     * 
     */
    class Api_ESDefault extends PhalApi_Api {

        public function getRules() {
            return array(
                //获取默认出库的仓库
                'getMainStore' => array(
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '商店号') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 获取默认出库的仓库(使用中,1.0,OK)
         * 20160901
         */
        public function getMainStore() {
            $getDefaultStore = new Domain_ESDefault();
            return $getDefaultStore->getDefaultStore($this);
        }
    }