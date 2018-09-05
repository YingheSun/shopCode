<?php

    class Model_AdminManage extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'admins';
        }

        public function adminadd($data) {
            return $this->getORM()
                            ->insert(array(
                                "phonenum" => $data->phonenum ,
                                "nickname" => $data->nickname ,
                                "time"     => time() ,
                                "password" => $data->password ,
                                "level"    => $data->level ,
                                "byadmin"  => $data->adminid
                                    )
            );
        }

        public function getAdminInfo($id) {
            return $this->getORM()->where("id" , $id)->fetchrow();
        }

        public function getAdminInfoByPhoneandPassword($data) {
            return $this->getORM()->where("phonenum" , $data->phonenum)->where("password" , $data->password)->where("ispermission" , 'yes')->fetchrow();
        }

        public function setAdminDisabled($id) {
            return $this->getORM()->where("id" , $id)->update(array('ispermission' => 'disabled'));
        }

        public function setAdminLevel($id , $level) {
            return $this->getORM()->where("id" , $id)->update(array('level' => $level));
        }

        public function setAdminpassword($id , $password) {
            return $this->getORM()->where("id" , $id)->update(array('password' => $password));
        }

        public function setAdminnickname($id , $nickname) {
            return $this->getORM()->where("id" , $id)->update(array('nickname' => $nickname));
        }

    }
    