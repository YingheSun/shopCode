<?php

    /**
     * 条码接口
     * @author: YHS 20160620 重构
     */
    class Domain_Barcode {

        public function barcodeinfo($barcode , $shopid) {
            $Model_Barcode = new Model_Barcode();
            $goodsInfo     = $Model_Barcode->searchInfoWithBarcode($barcode);
            if (!$goodsInfo) {
                $this->barcodemamage($barcode);
                $Model_Manager = new Model_GoodManage();
                $Model_Manager->addManageInfo($barcode , $shopid , 1);
                throw new PhalApi_Exception_BadRequest(T('no Info') , 701);
            } else if (empty($goodsInfo['typekind'])) {
                $this->barcodeTypemamage($barcode);
                $Model_Manager->addManageInfo($barcode , $shopid , 2);
            }
            return $goodsInfo;
        }

        public function getbarcodeinfo($barcode) {
            $Model_Barcode = new Model_Barcode();
            return $Model_Barcode->searchInfoWithBarcode($barcode);
        }

        public function barcodemamage($barcode) {
            $Model_BarcodeManage = new Model_BarcodeManage();
            $Model_BarcodeManage->addManageInfo($barcode);
            DI()->logger->info("条码缺失:$barcode");
        }

        public function barcodeTypemamage($barcode) {
            $Model_BarcodeManage = new Model_BarcodeManage();
            $Model_BarcodeManage->addTypeManageInfo($barcode);
            DI()->logger->info("条码分类缺失:$barcode");
        }

    }
    