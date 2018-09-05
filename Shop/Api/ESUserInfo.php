<?php

    /**
     * 用户信息详情接口服务类
     *
     * @author: YHS 20160603
     * @author: YHS 20160620 重构
     * @author: YHS 20160722 重构
     */
    class Api_ESUserInfo extends PhalApi_Api {

        public function getRules() {
            return array(
                //获取用户信息详情
                'getUserInfo' => array(
                    'userid'    => array(
                        'name'    => 'userid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '用户id') ,
                    'reqid'       => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
                'chgMyInfo'   => array(
                    'id'    => array(
                        'name'    => 'userid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '用户id') ,
                    'user_name' => array(
                        'name'    => 'name' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '姓名') ,
                    'phonenum'  => array(
                        'name'    => 'phonenum' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '电话') ,
                ) ,
            );
        }

        /**
         * 获取用户信息详情(使用中,1.0,OK)
         * 20160619
         * 20160720 1.0
         * @desc 查询用户信息详情 code: 104:不存在用户
         * @return string id 用户编号：重要信息，存储到本地
         * @return string user_name 名称：注册时存储固定值，之后可以通过个人信息管理修改
         * @return string user_level 用户级别：暂时未使用（默认99）
         * @return string permission 用户权限：暂时未使用（默认0）
         * @return string phonenum 电话号码：登录的凭证之一
         * @return string password 密码：登录的凭证之一
         * @return string states 用户状态：将来用于管理用户账号冻结的字段，现在未使用（默认1）
         * @return string roleid 用户角色：暂时未使用（默认visiter）
         * @return string bandto 用户绑定的商店，相当于用户在哪个商店工作中的字段，若有多个，需要选择
         * @return string uuid 用户的设备编号：用于快捷登录，更换设备的话会要求重新输入密码
         * @return string time 时间
         */
        public function getUserInfo() {
            $Domain_User = new Domain_User();
            //获取用户信息详情
            return $Domain_User->getUserById($this);
        }

        public function chgMyInfo() {
            $Domain_GetUser = new Domain_User();
            return $Domain_GetUser->updateMyInfo($this);
        }

    }
    