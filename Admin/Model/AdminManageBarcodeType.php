<?php

    class Model_AdminManagerBarcodeType extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'admin_type_manage';
        }

        public function addBarcodeType($data) {
            return $this->getORM()
                            ->insert(array(
                                "updateadminid" => $data->adminid ,
                                "barcode"       => $data->barcode ,
                                "time"          => time() ,
                                "type"          => $data->typekind ,
                                "states"        => "updated"
                                    )
            );
        }

    }
    