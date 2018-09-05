<?php

    class Model_Barcode extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'barcodes';
        }

        /**
         *  查询条码表数据
         */
        public function searchInfoWithBarcode($barcode) {
            return $this->getORM()->where("item_no" , $barcode)->fetchrow();
        }

    }
    