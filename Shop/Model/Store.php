<?php

    class Model_Store extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'store';
        }

        /**
         * 新增库房
         */
        public function addStore($storename , $id , $shopid) {
            $check = $this->getUserStoreInfo($id , $storename);
            if (!$check) {
                return $this->getORM()
                                ->insert(array(
                                    "stroe"    => $storename ,
                                    "kindsnum" => 0 ,
                                    "numbers"  => 0 ,
                                    "owner"    => $id ,
                                    "state"    => "using" ,
                                    "shopid"   => $shopid
                ));
            } else {
                throw new PhalApi_Exception_BadRequest(T("already Have Created This Store") , 502);
            }
        }

        /**
         * 获取库房信息
         * 20160620
         */
        public function getStoreInfo($id) {
            return $this->getORM()->where("id" , $id)->fetchall();
        }

        /**
         * 获取库房信息
         * 20160620
         */
        public function getStoreLastInfo($id) {
            return $this->getORM()->select("numbers")->where("id" , $id)->fetchrow();
        }

        /**
         * 修改库房信息
         * 20160622
         */
        public function changeStoreInfo($id , $stroe , $kindsnum , $numbers) {
            return $this->getORM()->where("id" , $id)->update(array('stroe' => $stroe , 'kindsnum' => $kindsnum , 'numbers' => $numbers));
        }

        public function updateStoreState($id , $state) {
            return $this->getORM()->where('id' , $id)->update(array('state' => $state));
        }

        public function getUserStoreList($owner) {
            return $this->getORM()->where("owner" , $owner)->fetchall();
        }

        public function getShopStoreList($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->fetchall();
        }

        public function getDefaultStore($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("extra2" , "default")->fetchrow();
        }

        public function getDefaultStore2($shopid) {
            return $this->getORM()->where("shopid" , $shopid)->where("extra2" , "default")->fetchall();
        }

        public function getShopStoreListWithType($shopid , $state) {
            return $this->getORM()->where("shopid" , $shopid)->where("state" , $state)->fetchall();
        }

        public function getStoreListWithTypeAndExtra($shopid , $state , $outstoreid) {
//            return $this->getORM()->where("shopid" , $shopid)->where("state" , $state)->where('id != ?' , $outstoreid)->where('extra2 != ?' , 'default')->fetchall();
            return $this->getORM()->where("shopid" , $shopid)->where("state" , $state)->where('id != ?' , $outstoreid)->fetchall();
        }

        public function getUserStoreInfo($owner , $stroe) {
            return $this->getORM()->where("owner" , $owner)->where("stroe" , $stroe)->fetch();
        }

        public function increaseKindInfo($id) {

            return $this->getORM()->where('id' , $id)->update(array('kindsnum' => new NotORM_Literal("kindsnum + 1")));
        }

        public function increaseNumberInfo($id , $number) {
            return $this->getORM()->where('id' , $id)->update(array('numbers' => new NotORM_Literal("numbers + $number")));
        }

        public function decreaseNumberInfo($id , $number) {
            return $this->getORM()->where('id' , $id)->update(array('numbers' => new NotORM_Literal("numbers - $number")));
        }

    }
    