<?php

    class Model_Syslog extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'syslog';
        }

        /**
         * 用户注册
         * @param type $data
         * @return type
         */
        public function addLog($data) {
            return $this->getORM()
                            ->insert(array(
                                "uid"   => $data['userid'] ,
                                "level" => $data['level'] ,
                                "info"  => $data['info'] ,
                                "extra" => "" ,
                                "time"  => time()
            ));
        }

    }
    