<?php

    class Api_AdminBatch extends PhalApi_Api {

        public function getRules() {
            return array(
                //添加用户
                'cardinbatch'  => array(
                    'adminid' => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 11 ,
                        'require' => true ,
                        'desc'    => '授权人id')
                ) ,
                'barcodebatch' => array(
                    'adminid' => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 11 ,
                        'require' => true ,
                        'desc'    => '授权人id')
                ) ,
                'typebatch' => array(
                    'adminid' => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 11 ,
                        'require' => true ,
                        'desc'    => '授权人id')
                ) ,
            );
        }

        /**
         * 授权人验证TODO
         * @return type
         */
        public function cardinbatch() {
            $Domain_batchCardin = new Domain_AdminBatchCard();
            return $Domain_batchCardin->batchCardIn($this->adminid);
        }

        /**
         * 授权人验证TODO
         * @return type
         */
        public function barcodebatch() {
            $Domain_batchBarcode = new Domain_AdminBarcodeBatch();
            return $Domain_batchBarcode->batchBarcode($this->adminid);
        }
        
        /**
         * 授权人验证TODO
         * @return type
         */
        public function typebatch(){
            $Domain_batchBarcode = new Domain_AdminBarcodeBatch();
            return $Domain_batchBarcode->batchBarcodetype($this->adminid);
        }

    }
    