<?php

    class Domain_Store {

        /**
         * 添加库房
         * @param type $data
         * @throws PhalApi_Exception_BadRequest
         */
        public function storeadd($data) {
            $model_Store = new Model_Store();
            $sid         = $model_Store->addStore($data);
            if (!$sid) {
                throw new PhalApi_Exception_BadRequest(T("Created This Store Error Occors") , 501);
            }
            return $sid['id'];
        }

    }
    