<?php

    class Domain_ESPLTGWar {

        public function getAllWar($data) {
            //get all shop's Store List
            $Domain_Store = new Domain_Manage();
            $stores       = $Domain_Store->getShopUsingStore($data);
            $retArr       = array();
            foreach ($stores as $key => $value) {
                $warArr = $this->execStoreWar($stores[$key]['id']);
                $retArr = array_merge($retArr , $warArr);
            }
            return $retArr;
        }

        public function execStoreWar($storeid) {
            $getStoreWar = new Model_ESPLTStore();
            return $getStoreWar->getWar($storeid);
        }

    }
    