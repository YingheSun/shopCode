<?php

    /**
     * 商品转库接口服务类
     */
    class Api_ESScanChg extends PhalApi_Api {

        public function getRules() {
            return array(
                //扫码出库
                'scanChg' => array(
                    'barcode' => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'min'     => 13 ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'number'  => array(
                        'name'    => 'number' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '数量') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'storeid' => array(
                        'name'    => 'storeid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '出库仓库编号') ,
                    'order'   => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 商品转库订单处理(使用,1.0,OK)
         * 20160722 1.0
         * @desc code：111扫码频率太快，上一次请求还未完成 扫码入库功能

         */
        public function scanChg() {
            $changeStore = new Domain_StoreChange();
            return $changeStore->scanChange($this);
        }

    }
    