<?php

    class Model_BandRequest extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'request_shop_band';
        }

        /**
         *  管理请求数据添加
         */
        public function addBandRequest($data) {
            return $this->getORM()
                            ->insert(array(
                                "requesterid" => $data->reqid ,
                                "requesttype" => $data->requesttype ,
                                "state"       => "new" ,
                                "identity"    => $data->identity ,
                                "shopid"      => $data->shopid ,
                                "time"        => time()
                                    )
            );
        }

    }
    