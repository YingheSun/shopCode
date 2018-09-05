<?php

    /**
     * 管理员条码管理接口服务类
     *
     * @author: YHS 20160629
     */
    class Api_AdminManageBarcode extends PhalApi_Api {

        public function getRules() {
            return array(
                //添加用户
                'addbarcode' => array(
                    'adminid'      => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '操作人id') ,
                    'barcode'      => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'item_name'    => array(
                        'name'    => 'itemname' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品名称') ,
                    'item_size'    => array(
                        'name'    => 'itemsize' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品包装大小') ,
                    'unit_no'      => array(
                        'name'    => 'unitno' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品单位') ,
                    'product_area' => array(
                        'name'    => 'productarea' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品产地') ,
                    'typekind'     => array(
                        'name'    => 'typekind' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品种类') ,
                ) ,
                'addtype'    => array(
                    'adminid'  => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '操作人id') ,
                    'barcode'  => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'typekind' => array(
                        'name'    => 'typekind' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商品种类') ,
                )
            );
        }

        /**
         * 添加条码信息
         * @desc 所有管理员都可以进行此项操作
         */
        public function addbarcode() {
            $Domain_AdminManage = new Domain_AdminBarcodeManage();
            return $Domain_AdminManage->manageBarcode($this);
        }

        /**
         * 添加条码类型信息
         * @desc 所有管理员都可以进行此项操作
         */
        public function addtype() {
//            $adminAddBarcodeType = new Model_AdminManagerBarcodeType();
//            return $adminAddBarcodeType->addBarcodeType($this);
            $Domain_AdminManage = new Domain_AdminBarcodeManage();
            return $Domain_AdminManage->manageType($this);
        }

    }
    