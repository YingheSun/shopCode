<?php

    class Domain_ESDefault {

        public function getDefaultStore($data) {
            $Model_Store = new Model_Store();
            return $Model_Store->getDefaultStore2($data->shopid);
        }

    }
    