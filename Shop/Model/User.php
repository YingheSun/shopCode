<?php

    class Model_User extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'user';
        }

        /**
         * 用户注册
         * @param type $data
         * @return type
         */
        public function addUser($data) {
            return $this->getORM()
                            ->insert(array(
                                "user_name"  => $data->username ,
                                "password"   => $data->password ,
                                "phonenum"   => $data->phonenum ,
                                "uuid"       => $data->uuid ,
                                "user_level" => 99 ,
                                "permission" => 0 ,
                                "roleid"     => "visiter" ,
                                "states"     => "locked" ,
                                "time"       => time()
            ));
        }

        /**
         * 用户注册
         * @param type $data
         * @return type
         */
        public function addShopUser($password , $phone , $shopid,$roleid) {
            return $this->getORM()
                            ->insert(array(
                                "user_name"  => "" ,
                                "password"   => $password ,
                                "phonenum"   => $phone ,
                                "uuid"       => "" ,
                                "user_level" => 10 ,
                                "permission" => 0 ,
                                "roleid"     => $roleid ,
                                "states"     => "locked" ,
                                "bandto"     => $shopid ,
                                "time"       => time()
            ));
        }

        /**
         * 通过电话获取用户信息
         */
        public function getUserInfoByPhone($phonenum) {
            return $this->getORM()->where("phonenum" , $phonenum)->fetchall();
        }

        /**
         * 通过电话，密码获取用户信息
         */
        public function getUserInfoByPhoneandPassword($phonenum , $password) {
            return $this->getORM()->limit(1)->where("phonenum" , $phonenum)->where("password" , $password)->fetchall();
        }

        /**
         * 通过电话，密码获取用户信息
         */
        public function getUserInfo($phonenum , $password) {
            return $this->getORM()->where("phonenum" , $phonenum)->where("password" , $password)->fetchrow();
        }

        public function getuserInfoByIdandBand($id , $bandId) {
            return $this->getORM()->limit(1)->where("id" , $id)->where("bandto" , $bandId)->fetchall();
        }

        public function getuserInfoById($id) {
            return $this->getORM()->limit(1)->where("id" , $id)->fetchall();
        }

        public function getuserListByShop($shopid) {
            return $this->getORM()->where("bandto" , $shopid)->fetchall();
        }

        public function getuserInfoByIdOne($id) {
            return $this->getORM()->where("id" , $id)->fetchrow();
        }

        public function updateBandWtihPhoneAndId($id , $bandid) {
            return $this->getORM()->where('id' , $id)->update(array('bandto' => $bandid));
        }

        public function updateRoleid($phonenum , $roleid) {
            return $this->getORM()->where('phonenum' , $phonenum)->update(array('roleid' => $roleid));
        }

        public function updateUserLevel($phonenum , $level) {
            return $this->getORM()->where('phonenum' , $phonenum)->update(array('user_level' => $level));
        }

        public function updatePermission($phonenum , $permission) {
            return $this->getORM()->where('phonenum' , $phonenum)->update(array('permission' => $permission));
        }

        public function updatePassword($id , $password) {
            return $this->getORM()->where('id' , $id)->update(array('password' => $password));
        }

        public function updateStates($phonenum , $states) {
            return $this->getORM()->where('phonenum' , $phonenum)->update(array('states' => $states));
        }

        public function updateUUID($phonenum , $uuid) {
            return $this->getORM()->where('phonenum' , $phonenum)->update(array('uuid' => $uuid));
        }

        public function getuserInfoByPhoneandUUID($id , $uuid) {
            return $this->getORM()->limit(1)->where("id" , $id)->where("uuid" , $uuid)->fetchall();
        }

        public function updateMyInfo($id , $name , $phone) {
            return $this->getORM()->where('id' , $id)->update(array('user_name' => $name , 'phonenum' => $phone));
        }

        public function updateshoperInfo($id , $name , $phone , $uuid) {
            return $this->getORM()->where('id' , $id)->update(array('user_name' => $name , 'phonenum' => $phone , 'uuid' => $uuid , 'states' => "using"));
        }

    }
    