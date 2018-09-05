<?php

    class Model_Benefit extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'benefit';
        }

        /**
         *  管理数据添加
         */
        public function addBenefitInfo($data) {
            return $this->getORM()
                            ->insert(array(
                                "shopid"    => $data->shopid ,
                                "type"      => $data->type ,
                                "level"     => $data->level ,
                                "extother"  => $data->extother ,
                                "barcode"   => $data->barcode ,
                                "codeone"   => $data->codeone ,
                                "codetwo"   => $data->codetwo ,
                                "codethree" => $data->codethree ,
                                "codefour"  => $data->codefour ,
                                "others"    => $data->others ,
                                "starttime" => $data->starttime ,
                                "endtime"   => $data->endtime ,
            ));
        }

    }
    