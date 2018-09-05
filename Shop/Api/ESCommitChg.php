<?php

    /**
     * 商品转库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESCommitChg extends PhalApi_Api {

        public function getRules() {
            return array(
                'commitOrder' => array(
                    'order'    => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'shopid'   => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '店铺号') ,
                    'storeout' => array(
                        'name'    => 'storeout' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '转出库房号') ,
                    'storeto'  => array(
                        'name'    => 'storein' ,
                        'type'    => 'int' ,
                        'require' => true ,
                        'desc'    => '转入库房号') ,
                    'reqid'    => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 提交订单(使用,1.0,OK)
         * 20160622
         * 20160722 1.0
         * @desc code: 112 已经被提交过了 提交订单接口

         */
        public function commitOrder() {
            $commit = new Domain_StoreChange();
            return $commit->commitChangeOrder($this);
        }

    }
    