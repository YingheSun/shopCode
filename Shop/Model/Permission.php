<?php

    class Model_Permission extends PhalApi_Model_NotORM {

        protected function getTableName($id) {
            return 'permission';
        }

        public function insertPermissionWithType($userid , $shopid , $id , $permission , $type) {

            return $this->getORM()
                            ->insert(array(
                                "userid"            => $userid ,
                                "shopid"            => $shopid ,
                                "permissiontype_id" => $id ,
                                "permission"        => $permission ,
                                "type"              => $type ,
                                    )
            );
        }

        public function getPermissions($type) {
            return DI()->notorm->permissiontype->where("permissiontype" , $type)->fetchall();
        }

        public function makePermissionWithShoper($userid , $shopid , $type) {
            $PermissionInfo = $this->getPermissions($type);
            foreach ((array) $PermissionInfo as $key => $val) {
                if ($val['id']) {
                    $this->checkPermissionDuplcate($userid , $PermissionInfo[$key]['id']);
                }
            }
            foreach ((array) $PermissionInfo as $key => $val) {
                if ($val['id']) {
                    $this->insertPermissionWithType($userid , $shopid , $val['id'] , $val['shoperdefault'] , $val['typeid']);
                }
            }
        }

        public function makePermissionWithMaster($userid , $shopid , $type) {
            $PermissionInfo = $this->getPermissions($type);
            foreach ((array) $PermissionInfo as $key => $val) {
                if ($val['id']) {
                    $this->checkPermissionDuplcate($userid , $PermissionInfo[$key]['id']);
                }
            }
            foreach ((array) $PermissionInfo as $key => $val) {
                if ($val['id']) {
                    $this->insertPermissionWithType($userid , $shopid , $val['id'] , $val['managerdefault'] , $val['typeid']);
                }
            }
        }

        public function getPermissionInformation($userid , $shopid) {
            return $this->getORM()->where("userid" , $userid)->where("permissiontype_id" , $shopid)->fetchrow();
        }

        public function checkPermissionDuplcate($userid , $shopid) {
            $duplcateCheck = $this->getPermissionInformation($userid , $shopid);
            if ($duplcateCheck) {
                throw new PhalApi_Exception_BadRequest(T("duplicate Insert") , 902);
            }
        }

        public function getPermissionsInfo($data) {
            return $this->getORM()->select('permissiontype.permissionname , permission')->where("userid" , $data->userid)->where("shopid" , $data->shopid)->fetchall();
        }

        public function getPermissionsInfos($user , $shopid) {
            return $this->getORM()->select(' permissiontype.permissionname , permission ,MRP_permission.id')->where("userid" , $user)->where("shopid" , $shopid)->fetchall();
        }

        public function getUserPermissionInfo($data) {
            return $this->getORM()->select('permission')->where("userid" , $data->userid)->where("shopid" , $data->shopid)->where("permissiontype_id" , $data->permissiontype)->fetchrow();
        }

        public function updateUserPermissionInfo($data) {
            $this->getORM()->where("userid" , $data->userid)->where("shopid" , $data->shopid)->where("permissiontype_id" , $data->permissiontype)->update(array("permission" => $data->permission));
            return $this->getUserPermissionInfo($data);
        }

        public function getPermissionInfo($userid , $shopid , $type) {
            return $this->getORM()->select('permission')->where("userid" , $userid)->where("shopid" , $shopid)->where("permissiontype_id" , $type)->fetchrow();
        }

    }
    