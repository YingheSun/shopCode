<?php

    class Model_UserCard extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'user_card';
        }

        /**
         * 用户添加打卡信息
         * @param type $data
         * @return type
         */
        public function addCardIn($data) {
            return $this->getORM()
                            ->insert(array(
                                "userid"   => $data->userid ,
                                "cardshop" => $data->bandshopid ,
                                "time"     => time() ,
                                "gpsx"     => $data->gpsx ,
                                "gpsy"     => $data->gpsy ,
                                "state"    => "updated"
                                    )
            );
        }

        public function getCardinTime($id) {
            return $this->getORM()->where('id' , $id)->fetchall();
        }

        public function changeCardState($id , $state) {
            return $this->getORM()->where('id' , $id)->update(array('state' => $state));
        }

        public function getUndoneInfo() {
            return $this->getORM()->where('state' , "updated")->fetchall();
        }

        public function getSmallestInfo() {
            return $this->getORM()->min('time')->where('state' , "updated")->fetchrow();
        }

        public function getDaysInfo($StartTime , $EndTime) {
            return $this->getORM()->where('time > ?' , $StartTime)->where('time < ?' , $EndTime)->where('state' , "updated")->fetchall();
        }

        public function SetDaysInfoState($startTime , $EndTime , $Oristate , $ChgState) {
            return $this->getORM()->where('time > ?' , $startTime)->where('time < ?' , $EndTime)->where('state' , $Oristate)->update(array('state' => $ChgState));
        }

        public function SetUserInfoState($uid , $shopid , $Oristate , $ChgState) {
            return $this->getORM()->where('userid' , $uid)->where('cardshop' , $shopid)->where('state' , $Oristate)->update(array('state' => $ChgState));
        }

    }
    