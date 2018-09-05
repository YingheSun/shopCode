<?php

    /**
     * 管理文件
     *
     * @author: YHS 20160720
     * 
     */
    class Domain_Manage {

        public function getShopInfo($data) {
            $Model_ShopInfo = new Model_Shop();
            return $Model_ShopInfo->getShopInfoById($data->shopid);
        }

        public function getShopUserList($data) {
            $ShopUserList = new Model_User();
            return $ShopUserList->getuserListByShop($data->shopid);
        }

        public function getShopUserPermissionList($data) {
            $ShopUserList = new Model_Permission();
            return $ShopUserList->getPermissionsInfos($data->reqid , $data->shopid);
        }

        public function changeShopInfo($data) {
            $Model_updateShopInfo = new Model_Shop();
            return $Model_updateShopInfo->updateInfo($data);
        }

        public function addStore($data) {
            $Model_addStore = new Model_Store();
            $Model_addStore->addStore($data->storeName , $data->reqid , $data->shopid);
            return $this->getShopStoreListType($data->shopid , "using");
        }

        public function addStoreInfo($id , $address , $detail) {
            
        }

        public function abendStore($data) {
            $Model_checkStore = new Model_Store();
            $rs               = $Model_checkStore->getStoreLastInfo($data->storeId);
            if ($rs["numbers"] == 0) {
                DI()->logger->info(" 库： $data->storeId  废弃操作 库存：" , $rs["numbers"]);
                $Model_abendStore = new Model_Store();
                $Model_abendStore->updateStoreState($data->storeId , "abended");
            } else {
                throw new PhalApi_Exception_BadRequest(T('can not abend this store') , 161);
            }
            return $this->getShopStoreListType($data->shopid , "using");
        }

        public function changeStoreInfo($data) {
            $Model_changeStore = new Model_Store();
            $Model_changeStore->changeStoreInfo($data->storeId , $data->storeName , $data->kindsnum , $data->numbers);
            return $this->getStoreInfo($data);
        }

        public function getStoreList($data) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getShopStoreList($data->shopid);
        }

        public function getShopStoreListWithType($data) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getShopStoreListWithType($data->shopid , $data->state);
        }

        public function getShopUsingStore($data) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getShopStoreListWithType($data->shopid , "using");
        }

        public function getShopOtherStore($data) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getStoreListWithTypeAndExtra($data->shopid , "using" , $data->outstoreid);
        }

        public function getShopStoreListType($shopid , $state) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getShopStoreListWithType($shopid , $state);
        }

        public function reuseStore($data) {
            $Model_getStoreList = new Model_Store();
            $Model_getStoreList->updateStoreState($data->storeId , "using");
            return $this->getShopStoreListType($data->shopid , "abended");
        }

        public function getStoreInfo($data) {
            $Model_getStoreList = new Model_Store();
            return $Model_getStoreList->getStoreInfo($data->storeId);
        }

    }
    