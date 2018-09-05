<?php

    class Domain_AdminBarcodeBatch {

        /**
         * 条码批处理
         * 从条码管理表到条码表和商品表
         */
        public function batchBarcode() {
            $manageInfo = $this->getBarcodeManageInfo();
            foreach ((array) $manageInfo as $key => $val) {
                if ($val['id']) {
                    $this->ChangeManageState($manageInfo[$key]['id'] , "locked");
                }
            }
            foreach ((array) $manageInfo as $key => $val) {
                if ($val['id']) {
                    //更新barcode表
                    $rs1 = $this->AddBarcodeInfo($manageInfo[$key]['barcode'] , $manageInfo[$key]['item_name'] , $manageInfo[$key]['item_size'] , $manageInfo[$key]['unit_no'] , $manageInfo[$key]['product_area'] , $manageInfo[$key]['typekind']);
                    DI()->logger->info("第$rs1 条数据插入条码表");
                    //更新good信息表
                    $rs2 = $this->ChangeGoodsInfo($manageInfo[$key]['barcode'] , $manageInfo[$key]['item_name'] , $manageInfo[$key]['typekind']);
                    DI()->logger->info("$rs2 条数据更新商品名称,分类");
                    $this->ChangeManageState($manageInfo[$key]['id'] , "finish");
                }
            }
        }

        /**
         * 条码类型批处理
         * 从条码类型管理表到条码表和商品表
         */
        public function batchBarcodetype() {
            $typeInfos = $this->getBarcodeTypeManageInfo();
            foreach ((array) $typeInfos as $key => $val) {
                if ($val['id']) {
                    $this->ChangeTypeState($typeInfos[$key]['id'] , "locked");
                }
            }
            foreach ((array) $typeInfos as $key => $val) {
                if ($val['id']) {
                    //更新barcode表
                    $rs1 = DI()->notorm->barcodes->where("item_no" , $typeInfos[$key]['barcode'])->update(array("typekind" => $typeInfos[$key]['type']));
                    DI()->logger->info("条码表更新 $rs1 条数据");
                    //更新good信息表
                    $rs2 = DI()->notorm->goods->where("barcode" , $typeInfos[$key]['barcode'])->update(array("goods_type" => $typeInfos[$key]['type']));
                    DI()->logger->info("$rs2 条数据更新商品名称,分类");
                    $this->ChangeTypeState($typeInfos[$key]['id'] , "finish");
                }
            }
        }

        public function getBarcodeManageInfo() {
            $getUndoneInfo = new Model_AdminBarcode();
            return $getUndoneInfo->getundoneInfo();
        }

        public function getBarcodeTypeManageInfo() {
            $getUndoneInfo = new Model_AdminManageType();
            return $getUndoneInfo->getAllInfo();
        }

        public function AddBarcodeInfo($item_no , $item_name , $item_size , $unit_no , $product_area , $typekind) {
            $barcodeAdd = new Model_BarcodeAdd();
            return $barcodeAdd->BarcodeAdd($item_no , $item_name , $item_size , $unit_no , $product_area , $typekind);
        }

        public function ChangeGoodsInfo($barcode , $item_name , $typekind) {
            return DI()->notorm->goods->where("barcode" , $barcode)->update(array("goods_name" => $item_name , "goods_type" => $typekind));
        }

        public function ChangeManageState($id , $state) {
            $LockState = new Model_AdminBarcode();
            $LockState->changeStates($id , $state);
        }

        public function ChangeTypeState($id , $state) {
            $LockState = new Model_AdminManageType();
            $LockState->changeStates($id , $state);
        }

    }
    