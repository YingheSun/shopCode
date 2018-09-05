<?php

    class Domain_AdminBarcodeManage {

        /**
         * 条码管理
         */
        public function manageBarcode($data) {
            $Model_check = new Model_AdminBarcode();
            $rs          = $Model_check->getManageInfo($data->barcode);
            if (!empty($rs)) {
                throw new PhalApi_Exception_BadRequest(T('already managed') , 330);
            } else {
                $Model_Barcode = new Model_AdminBarcode();
                $Model_Barcode->addBarcode($data);
            }
            return 'ok';
        }

        public function manageType($data) {
            $Model_check = new Model_AdminManageType();
            $rs          = $Model_check->getManageInfo($data->barcode);
            if (!empty($rs)) {
                throw new PhalApi_Exception_BadRequest(T('already managed') , 330);
            } else {
                $Model_Barcode = new Model_AdminManageType();
                $Model_Barcode->addBarcodeType($data);
            }
            return 'ok';
        }

    }
    