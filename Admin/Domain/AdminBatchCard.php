<?php

    class Domain_AdminBatchCard {

        /**
         * 开始时间：update状态的最小时间当天的0点0分0秒
         * 结束时间：当天上一天的23时59分59秒
         */
        public function batchCardIn() {
            $startTime     = $this->getBJTime($this->getStartTime());
            $starthis      = date("Y-m-d" , $startTime);
            DI()->logger->info("开始打卡批处理：数据开始日期：$starthis");
            $secondsOneDay = 60 * 60 * 24;
            $now           = time();
            $yesterday     = $now - $secondsOneDay;
            $endTime       = $this->getBJTime(mktime(23 , 59 , 59 , date("n" , $yesterday) , date("j" , $yesterday) , date("Y" , $yesterday)));
            $endhis        = date("Y-m-d" , $endTime);
            DI()->logger->info("开始打卡批处理：数据结束日期：$endhis");
            for ($time = $startTime; $time < $endTime; $time = $time + $secondsOneDay) {
                $day = date("Y-m-d" , $time);
                DI()->logger->info("开始 $day 日的批处理");
                $this->BatchOneDay($time);
            }
        }

        public function BatchOneDay($startTime) {
            $secondsOneDay = 60 * 60 * 24;
            $TodayEndTime  = $startTime + $secondsOneDay - 1;
            $todayData     = $this->getDayInfo($startTime , $TodayEndTime);
            $this->SetDayInfoState($startTime , $TodayEndTime , "updated" , "locked");
            foreach ((array) $todayData as $key => $val) {
                if ($val['id']) {
                    $this->insertRowIntoCOMPTB($todayData[$key]['userid'] , $todayData[$key]['cardshop'] , $todayData[$key]['time']);
                }
            }
            if (!empty($todayData)) {
                $this->execData();
            }
        }

        public function execData() {
            $rs         = DI()->notorm->batch_cardin_info_storage->fetchOne();
            $startTime  = DI()->notorm->batch_cardin_info_storage->where('cardshop' , $rs['cardshop'])->where('userid' , $rs['userid'])->min('time');
            $starthis   = date("H:i:s" , $startTime);
            $endTime    = DI()->notorm->batch_cardin_info_storage->where('cardshop' , $rs['cardshop'])->where('userid' , $rs['userid'])->max('time');
            $endhis     = date("H:i:s" , $endTime);
            $date       = date("Y-m-d" , $endTime);
            $duringTime = ($endTime - $startTime) / 60 / 60;
            $insertData = new Model_AdminBatchCard();
            $insertData->cardInfoAdd($rs['userid'] , $rs['cardshop'] , $date , 1 , $duringTime , $starthis , $endhis);
            $this->SetUserInfoState($rs['userid'] , $rs['cardshop'] , "locked" , "finish");
            $this->deleteUserAllData($rs['userid'] , $rs['cardshop']);
            $checkLoop  = DI()->notorm->batch_cardin_info_storage->fetchOne();
            if ($checkLoop) {
                $this->execData();
            }
        }

        public function deleteUserAllData($uid , $shopid) {
            DI()->notorm->batch_cardin_info_storage->where('userid' , $uid)->where('cardshop' , $shopid)->delete();
        }

        public function getDayInfo($startTime , $EndTime) {
            $getInfo = new Model_UserCard();
            return $getInfo->getDaysInfo($startTime , $EndTime);
        }

        public function SetDayInfoState($startTime , $EndTime , $Oristate , $ChgState) {
            $getInfo = new Model_UserCard();
            $rs      = $getInfo->SetDaysInfoState($startTime , $EndTime , $Oristate , $ChgState);
            DI()->logger->info("$rs 条数据 更新状态：$Oristate 到 $ChgState 从 时间$startTime 到 $EndTime");
        }

        public function SetUserInfoState($uid , $shopid , $Oristate , $ChgState) {
            $getInfo = new Model_UserCard();
            $rs      = $getInfo->SetUserInfoState($uid , $shopid , $Oristate , $ChgState);
            DI()->logger->info("$rs 条数据 更新状态：$shopid 号商店的 $uid 从 $Oristate 到 $ChgState 状态");
        }

        public function getStartTime() {
            $cardTime  = new Model_UserCard();
            $FirstTime = $cardTime->getSmallestInfo();
            return mktime(12 , 0 , 0 , date("n" , $FirstTime) , date("j" , $FirstTime) , date("Y" , $FirstTime));
        }

        public function getBJTime($unixtime) {
            $secondsOneDay = 60 * 60 * 24;
            return $unixtime - 0.5 * $secondsOneDay;
        }

        public function insertRowIntoCOMPTB($uid , $sid , $time) {
            DI()->notorm->batch_cardin_info_storage->insert(array("userid" => $uid , "cardshop" => $sid , "time" => $time));
        }

    }
    