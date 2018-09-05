<?php

    class Model_Storage extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'storage';
        }

        public function insertStore($storgeid , $number , $goodid) {
            $info = $this->searchGood($goodid , $storgeid);
            if (!$info) {
                //新建数据
                $this->addNewGood($storgeid , $number);
                return $this->getORM()
                                ->insert(array(
                                    "storeid" => $storgeid ,
                                    "goodid"  => $goodid ,
                                    "number"  => $number
                ));
            } else {
                $Model_Store = new Model_Store();
                $Model_Store->increaseNumberInfo($storgeid , $number);
                return $this->getORM()->where('storeid' , $storgeid)->where('goodid' , $goodid)->update(array('number' => new NotORM_Literal("number + $number")));
            }
        }

        public function searchGood($goodid , $storageid) {
            return $this->getORM()->where('goodid' , $goodid)->where('storeid' , $storageid)->fetchrow();
        }

        public function searchGoodbyID($id) {
            return $this->getORM()->where('id' , $id)->fetchrow();
        }

        public function updateStoreNum($storgeid , $number , $goodid) {
            $this->updateStoreNumInfo($storgeid , $number , $goodid);
            return $this->getORM()->where('storeid' , $storgeid)->where('goodid' , $goodid)->update(array('number' => $number));
        }

        public function updateWarningLine($storgeid , $line , $goodid) {
            return $this->getORM()->where('storeid' , $storgeid)->where('goodid' , $goodid)->update(array('warningline' => $line));
        }

        public function addNewGood($storgeid , $number) {
            $Model_Store  = new Model_Store();
            $Model_Store->increaseNumberInfo($storgeid , $number);
            $Model_Store2 = new Model_Store();
            $Model_Store2->increaseKindInfo($storgeid);
        }

        public function updateStoreNumInfo($storgeid , $number , $goodid) {
            $goodinfo     = $this->getORM()->where('goodid' , $goodid)->where('storeid' , $storgeid)->fetchrow();
            $changenumber = $number - $goodinfo['number'];
            $Model_Store  = new Model_Store();
            $Model_Store->increaseNumberInfo($storgeid , $changenumber);
        }

        public function outStore($storgeid , $number , $goodid) {
            $Model_Store = new Model_Store();
            $Model_Store->decreaseNumberInfo($storgeid , $number);
            return $this->getORM()->where('storeid' , $storgeid)->where('goodid' , $goodid)->update(array('number' => new NotORM_Literal("number - $number")));
        }

    }
    