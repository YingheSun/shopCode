<?php

    class Model_AdminBatchCard extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'batch_cardin';
        }

        public function cardInfoAdd($userid , $shopid , $date , $states , $duringtime , $starttime , $endtime) {
            return $this->getORM()
                            ->insert(array(
                                "userid"     => $userid ,
                                "shopid"     => $shopid ,
                                "date"       => $date ,
                                "states"     => $states ,
                                "duringtime" => $duringtime ,
                                "starttime"  => $starttime ,
                                "endtime"    => $endtime
                                    )
            );
        }

    }
    