<?php

    class Model_BarcodeAdd extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'barcodes';
        }

        public function BarcodeAdd($item_no , $item_name , $item_size , $unit_no , $product_area , $typekind) {
            return $this->getORM()
                            ->insert(array(
                                "item_no"      => $item_no ,
                                "item_name"    => $item_name ,
                                "item_size"    => $item_size ,
                                "unit_no"      => $unit_no ,
                                "product_area" => $product_area ,
                                "typekind"     => $typekind
                                    )
            );
        }

    }
    