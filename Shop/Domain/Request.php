<?php

    class Domain_Request {

        public function shopaddrequest($data) {
            $Model_Request = new Model_Request();
            $reqid         = $Model_Request->shopaddrequest($data);
            if (!$reqid) {
                throw new PhalApi_Exception_BadRequest(T("add Request Failed" , 801));
            }
            return $reqid['id'];
        }

        public function getrequest($id) {
            $Model_Request = new Model_Request();
            return $Model_Request->getRequestInfo($id);
        }

        public function getUnDoneRequest() {
            $Model_Request = new Model_Request();
            $reqid         = $Model_Request->getUnDoneShop();
            if (!$reqid) {
                throw new PhalApi_Exception_BadRequest(T("no request left" , 802));
            }
            return $reqid;
        }

        public function skipRequest($id) {
            $Model_Request = new Model_Request();
            $reqreqult     = $Model_Request->uploadskip($id);
            if ($reqreqult === FALSE) {
                throw new PhalApi_Exception_BadRequest(T("error occors uploading skip" , 803));
            }
            //return '绑定成功';
            $Logdata   = array('userid' => 0 , 'level' => "99" , 'info' => "$id ,处理被跳过");
            $this->addLog($Logdata);
            
                return '操作成功';
            }

        public function requestDone($id) {
            $reqinfo       = $this->getrequest($id);
            //创建商店信息
            $data1         = array('shop_name' => $reqinfo['shopname'] , 'telephone' => $reqinfo['telephone'] , 'shop_address' => $reqinfo['address'] , 'callphone' => $reqinfo['callphone'] , 'introduce' => "" , 'weixin' => "" , 'gpsx' => $reqinfo['gpsx'] , 'gpsy' => $reqinfo['gpsy'] , 'owner' => $reqinfo['telephone']);
            $shopid        = $this->shopadd($data1);
            //写入日志
            $Logdata1      = array('userid' => 0 , 'level' => "99" , 'info' => "$shopid ,商店被创建");
            $this->addLog($Logdata1);
            //添加仓库
            $storeid       = $this->storeadd($reqinfo['telephone']);
            //写入日志
            $Logdata3      = array('userid' => 0 , 'level' => "99" , 'info' => "$storeid ,仓库创建完成");
            $this->addLog($Logdata3);
            //转换请求状态
            $Model_Request = new Model_Request();
            $reqreqult     = $Model_Request->uploadDone($id);
            if ($reqreqult === FALSE) {
                throw new PhalApi_Exception_BadRequest(T("done failed" , 806));
            }
            //写入日志
            $Logdata = array('userid' => 0 , 'level' => "99" , 'info' => "$id ,处理被执行");
            $this->addLog($Logdata);
            return '操作成功';
        }

        /**
         * 
         * @param type $data
         * @throws PhalApi_Exception_BadRequest
         */
        public function storeadd($data) {
            $model_Store = new Model_Store();
            $sid         = $model_Store->addStore($data);
            if (!$sid) {
                throw new PhalApi_Exception_BadRequest(T("add store failed" , 805));
            }
            return $sid['id'];
        }

        /**
         * 
         * @param type $data
         * @throws PhalApi_Exception_BadRequest
         */
        public function shopadd($data) {
            $Model_Shop = new Model_Shop();
            $shopid     = $Model_Shop->addShop($data);
            if (!$shopid) {
                throw new PhalApi_Exception_BadRequest(T("添加商店操作失败" , 9));
            }
            return $shopid['id'];
        }

        public function updateBandWtihPhoneAndId($phonenum , $id) {
            $Model_User = new Model_User();
            $userbanded = $Model_User->updateBandWtihPhoneAndId($phonenum , $id);
            if ($userbanded === FALSE) {
                throw new PhalApi_Exception_BadRequest(T("更新失败") , 5);
            } else if ($userbanded === 0) {
                throw new PhalApi_Exception_BadRequest(T("已经绑定过了") , 4);
            }

            //return '绑定成功';
            $Model_UserLog = new Model_User();
            $uid           = $Model_UserLog->getUserInfoByPhone($phonenum);
            //获取商家信息
            $shopinfo      = $this->searchShop($id);
            $shopname      = $shopinfo["shop_name"];
            $Logdata       = array('userid' => intval($uid['id']) , 'level' => "99" , 'info' => "用户绑定:$shopname");
            $logstates     = $this->addLog($Logdata);
            if ($logstates == "logok") {
                return '绑定成功';
            } else {
                $this->addLog($Logdata);
                return '绑定成功';
            }
        }

        public function searchShop($telephone) {
            $Model_Shop = new Model_Shop();
            $ids        = $Model_Shop->getShopInfo($telephone);
            if ($ids) {
                throw new PhalApi_Exception_BadRequest(T("已经有店铺，操作失败" , 9));
            }
        }

        //添加日志
        public function addLog($Logdata) {
            $Model_Syslog = new Model_Syslog();
            $id           = $Model_Syslog->addLog($Logdata);
            if ($id) {
                return "logok";
            }
            return "error";
        }

    }
    