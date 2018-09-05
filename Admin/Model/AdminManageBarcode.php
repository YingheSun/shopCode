<?php

    class Model_AdminManagerBarcode extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'admin_barcode_manage';
        }

        protected function addBarcode($data) {
            return $this->getORM()
                            ->insert(array(
                                "updateadminid" => $data->adminid ,
                                "barcode"       => $data->barcode ,
                                "time"          => time() ,
                                "item_name"     => $data->item_name ,
                                "item_size"     => $data->item_size ,
                                "unit_no"       => $data->unit_no ,
                                "product_area"  => $data->product_area ,
                                "typekind"      => $data->typekind ,
                                "states"        => "updated"
                                    )
            );
        }

    }
    