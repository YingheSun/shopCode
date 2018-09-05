<?php

    class Model_Shop extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'shops';
        }

        /**
         * 新增商店
         */
        public function addShop($data) {
            return $this->getORM()
                            ->insert(array(
                                "shop_name"    => $data->shop_name ,
                                "shop_address" => $data->shop_address ,
                                "callphone"    => $data->callphone ,
                                "telephone"    => $data->telephone ,
                                "introduce"    => $data->introduce ,
                                "weixin"       => $data->weixin
            ));
        }

        /**
         * 获取商店信息
         */
        public function getShopInfo($telephone) {
            return $this->getORM()->where("telephone" , $telephone)->fetchrow();
        }

        /**
         * 获取商店的基本信息
         */
        public function getShopInfoById($id) {
            return $this->getORM()->where("id" , $id)->fetchall();
        }
        
        /**
         * 获取商店的基本信息
         */
        public function getShopInfoByIdOne($id) {
            return $this->getORM()->where("id" , $id)->fetchrow();
        }

        /**
         * 获取商店列表
         * @return type
         */
        public function getShopList() {
            return $this->getORM()->select("shop_name" , "telephone")->fetchall();
        }

        /**
         * 更新店长信息
         * @return type
         */
        public function updateOwner($data) {
            return $this->getORM()->where('telephone' , $data->telephone)->update(array('owner' => $data->owner));
        }

        /**
         * 更新店铺信息
         */
        public function updateInfo($data) {
            return $this->getORM()->where("id" , $data->shopid)->update(array('shop_name' => $data->shop_name , 'shop_address' => $data->shop_address , 'callphone' => $data->callphone , 'telephone' => $data->telephone , 'introduce' => $data->introduce , 'weixin' => $data->weixin));
        }

    }
    