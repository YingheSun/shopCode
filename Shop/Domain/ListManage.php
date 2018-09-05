<?php

    /**
     * 管理
     *
     * @author: YHS 20160727
     * 
     */
    class Domain_ListManage {

        public function getRootList($data) {
            $getRootList = new Model_ListManage();
            return $getRootList->getRootList($data->shopid);
        }

        public function getOtherList($data) {
            $getRootList = new Model_ListManage();
            return $getRootList->getOtherList($data->shopid , $data->reqType);
        }
        
        public function getSettingRootList($data) {
            $getRootList = new Model_ListSetting();
            return $getRootList->getRootList($data->shopid);
        }

        public function getOtherSettingList($data) {
            $getRootList = new Model_ListSetting();
            return $getRootList->getOtherList($data->shopid , $data->reqType);
        }
        
        public function getMyRootList($data) {
            $getRootList = new Model_ListMy();
            return $getRootList->getRootList($data->shopid);
        }

        public function getMyOtherList($data) {
            $getRootList = new Model_ListMy();
            return $getRootList->getOtherList($data->shopid , $data->reqType);
        }

    }
    