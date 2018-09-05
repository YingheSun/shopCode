<?php

    /**
     * 用户注册接口服务类
     *
     * @author: YHS 20160603
     * @author: YHS 20160620 重构
     * @author: YHS 20160722 重构
     */
    class Api_ESRegister extends PhalApi_Api {

        public function getRules() {
            return array(
                //添加用户
                'UserAdd' => array(
                    'phonenum' => array(
                        'name'    => 'phonenum' ,
                        'type'    => 'string' ,
                        'min'     => 11 ,
                        'require' => true ,
                        'desc'    => '用户电话号码') ,
                    'username' => array(
                        'name'    => 'username' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '用户的名称') ,
                    'password' => array(
                        'name'    => 'password' ,
                        'type'    => 'string' ,
                        'min'     => 6 ,
                        'max'     => 32 ,
                        'require' => true ,
                        'desc'    => '用户密码') ,
                    'uuid'     => array(
                        'name' => 'uuid' ,
                        'type' => 'string' ,
                        'desc' => '设备标识') ,
                ) ,
            );
        }

        /**
         * 添加用户(使用中,1.0,OK)
         * 20160619
         * @desc 验证电话是否已经注册过->创建用户信息 code：101：添加错误 102：用户已存在
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
        public function UserAdd() {
            $Domain_User = new Domain_User();
            //验证电话是否已经注册过
            $Domain_User->checkPhone($this->phonenum);
            //创建用户信息
            return $Domain_User->useradd($this);
        }

    }
    