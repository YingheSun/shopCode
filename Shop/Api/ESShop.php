<?php

    class Api_ESShop extends PhalApi_Api {

        public function getRules() {
            return array(
                //获取商店信息
                'getShopInfo' => array(
                    'id' => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店id')
                ) ,
            );
        }

        //根据ID号查询商店
        /**
         * 根据ID号查询商店
         * @desc code:508 没有这个商店
         */
        public function getShopInfo() {
            $Domain_Shop = new Domain_Shop();
            //查询信息
            return $Domain_Shop->getShopInfoById($this);
        }

    }
    