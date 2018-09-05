<?php

    class Domain_Shop {

        public function shopadd($data) {
            $Model_Shop = new Model_Shop();
            $shopid     = $Model_Shop->addShop($data);
            if (!$shopid) {
                throw new PhalApi_Exception_BadRequest(T("add failed" , 509));
            }
            return $shopid['id'];
        }

        public function checkShopExistingState($telephone) {
            $Model_Shop = new Model_Shop();
            $Shopinfo   = $Model_Shop->getShopInfo($telephone);
            if ($Shopinfo) {
                throw new PhalApi_Exception_BadRequest(T("shop already exist") , 510);
            }
        }

        public function getShopInfo($telephone) {
            $Model_Shop = new Model_Shop();
            $Shopinfo   = $Model_Shop->getShopInfo($telephone);
            if (!$Shopinfo) {
                throw new PhalApi_Exception_BadRequest(T("shop not exist") , 508);
            }
            return $Shopinfo;
        }
        
        public function getShopInfoById($data) {
            $Model_Shop = new Model_Shop();
            $ShopInfo   = $Model_Shop->getShopInfoById($data->id);
            if (!$ShopInfo) {
                throw new PhalApi_Exception_BadRequest(T("shop not exist") , 508);
            }
            return $ShopInfo;
        }

        public function getShopList() {
            $Model_Shop = new Model_Shop();
            $ShopList   = $Model_Shop->getShopList();
            return $ShopList;
        }

        /**
         * 更新商店店长
         */
        public function updateOwner($data) {
            $shopinfo = $this->getShopInfo($data->telephone);
            if (strlen($shopinfo['owner'])) {
                throw new PhalApi_Exception_BadRequest(T("has been banded") , 507);
            }
            $shoptele              = $shopinfo['telephone'];
            $shopname              = $shopinfo['shop_name'];
            $this->checkPhone($data->owner);
            $Model_Shop            = new Model_Shop();
            $shopownerUpdateStates = $Model_Shop->updateOwner($data);
            if ($shopownerUpdateStates === false) {
                throw new PhalApi_Exception_BadRequest(T("update owner failed") , 506);
            }
            DI()->logger->info("$data->owner 成为:$shopname($shoptele)店长");
            return '绑定成功';
        }

        public function checkPhone($phonenum) {
            $Model_User = new Model_User();
            $userinfo   = $Model_User->getUserInfoByPhone($phonenum);
            if (!$userinfo) {
                throw new PhalApi_Exception_BadRequest(T("No This User") , 505);
            }
        }

        public function addLog($Logdata) {
            $Model_Syslog = new Model_Syslog();
            $id           = $Model_Syslog->addLog($Logdata);
            if ($id) {
                return "logok";
            }
            return "error";
        }

    }
    