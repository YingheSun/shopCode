<?php

    class Model_AdminManageType extends PhalApi_Model_NotORM {

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

        public function getManageInfo($barcode) {
            return $this->getORM()->where("barcode" , $barcode)->fetchrow();
        }

        public function getAllInfo() {
            return $this->getORM()->where("states" , "updated")->fetchall();
        }

        public function changeStates($id , $state) {
            return $this->getORM()->where("id" , $id)->update(array('states' => $state));
        }

    }
    