<?php

    class Domain_ESChgPermit {

        public function makePermitOn($data) {
            $makeChg      = new Model_ESChgPermit();
            $makeChg->makePermitOn($data->id);
            $ShopUserList = new Model_Permission();
            return $ShopUserList->getPermissionsInfos($data->reqid , $data->shopid);
        }

        public function makePermitOff($data) {
            $makeChg      = new Model_ESChgPermit();
            $makeChg->makePermitOff($data->id);
            $ShopUserList = new Model_Permission();
            return $ShopUserList->getPermissionsInfos($data->reqid , $data->shopid);
        }

    }
    