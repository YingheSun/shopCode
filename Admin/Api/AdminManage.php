<?php

    /**
     * 管理员接口服务类
     *
     * @author: YHS 20160623
     */
    class Api_AdminManage extends PhalApi_Api {

        public function getRules() {
            return array(
                //添加用户
                'adminadd'         => array(
                    'phonenum' => array(
                        'name'    => 'phonenum' ,
                        'type'    => 'string' ,
                        'min'     => 11 ,
                        'require' => true ,
                        'desc'    => '管理员电话号码') ,
                    'nickname' => array(
                        'name'    => 'nickname' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '昵称') ,
                    'adminid'  => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '授权人id') ,
                    'password' => array(
                        'name'    => 'password' ,
                        'type'    => 'string' ,
                        'min'     => 6 ,
                        'max'     => 32 ,
                        'require' => true ,
                        'desc'    => '管理员密码') ,
                    'level'    => array(
                        'name'    => 'level' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '管理员级别')
                ) ,
                'deleteadmin'      => array(
                    'phonenum' => array(
                        'name'    => 'phonenum' ,
                        'type'    => 'string' ,
                        'min'     => 11 ,
                        'require' => true ,
                        'desc'    => '管理员电话号码') ,
                    'adminid'  => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '授权人id') ,
                    'delid'    => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '删除人id') ,
                ) ,
                'adminlogin'       => array(
                    'phonenum' => array(
                        'name'    => 'phonenum' ,
                        'type'    => 'string' ,
                        'min'     => 11 ,
                        'require' => true ,
                        'desc'    => '管理员电话号码') ,
                    'password' => array(
                        'name'    => 'password' ,
                        'type'    => 'string' ,
                        'min'     => 6 ,
                        'require' => true ,
                        'desc'    => '管理员密码')
                ) ,
                'setadminpassword' => array(
                    'id'       => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '管理员id') ,
                    'adminid'  => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '授权人id') ,
                    'password' => array(
                        'name'    => 'password' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '删除人id') ,
                ) ,
                'setadminlevel'    => array(
                    'id'      => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '管理员id') ,
                    'adminid' => array(
                        'name'    => 'adminid' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '授权人id') ,
                    'level'   => array(
                        'name'    => 'level' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '管理员级别')
                ) ,
                'setadminnickname' => array(
                    'nickname' => array(
                        'name'    => 'nickname' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '昵称') ,
                    'id'       => array(
                        'name'    => 'id' ,
                        'type'    => 'string' ,
                        'min'     => 1 ,
                        'max'     => 16 ,
                        'require' => true ,
                        'desc'    => '管理员id')
                ) ,
            );
        }

        /**
         * 添加管理员
         * @desc code: 922 没有这个设置的权限
         */
        public function adminadd() {
            $Domain_adminadd = new Domain_AdminManage();
            return $Domain_adminadd->adminadd($this);
        }

        /**
         * 删除管理员
         * @desc code: 923 当前用户没有这个权限
         */
        public function admindelete() {
            $Domain_admindel = new Domain_AdminManage();
            return $Domain_admindel->deleteadmin($this);
        }

        /**
         * 管理员登录
         * @desc code: 923 当前用户没有这个权限
         */
        public function adminlogin() {
            $Domain_adminlogin = new Domain_AdminManage();
            return $Domain_adminlogin->adminlogin($this);
        }

    }
    