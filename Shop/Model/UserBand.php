<?php

    class Model_UserBand extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'user_shop';
        }

        /**
         * 用户添加绑定的商户
         * @param type $data
         * @return type
         */
        public function addUserBand($data) {
            return $this->getORM()
                            ->insert(array(
                                "user_id"    => $data->id ,
                                "shops_id"   => $data->bandshopid ,
                                "process_id" => 1 ,
                                "time"       => time() ,
                                    )
            );
        }

        /**
         * 通过电话获取用户所绑定过得商店信息
         */
        public function getUseBandInfoByid($id) {
            return $this->getORM()->select('shops_id,shops.shop_name,shops.telephone')->where("user_id" , $id)->where("process_id" , 5)->fetchall();
        }

        /**
         * 获取所有的商店相关的请求
         */
        public function getRequestInfo($shops_id) {
            return $this->getORM()->select('user_shop.id , user_id , process_id , user.user_name , process.process')->where("shops_id" , $shops_id)->where("process.type" , 1)->fetchall();
        }

        /**
         * 更新绑定状态
         */
        public function updateBandState($id , $state) {
            return $this->getORM()->where('id' , $id)->update(array('process_id' => $state));
        }

        
        public function getBandInfo($id) {
            return $this->getORM()->where('id' , $id)->fetchrow();
        }

    }
    