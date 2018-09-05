<?php

    /**
     * 商品销售接口服务类
     *
     * @author: YHS 20160603
     * 
     */
    class Api_ESScanOut extends PhalApi_Api {

        public function getRules() {
            return array(
                //扫码出库
                'scanOut' => array(
                    'barcode' => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '条码号') ,
                    'number'  => array(
                        'name'    => 'number' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '数量') ,
                    'order'   => array(
                        'name'    => 'order' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '订单号') ,
                    'shopid'  => array(
                        'name'    => 'shopid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '商店编号') ,
                    'userid'  => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 商品出库订单处理(使用,1.0,OK)
         * 20160722 1.0
         * @desc code：111扫码频率太快，上一次请求还未完成 113 没有足够库存 扫码出库
         * @return string id 编号
         * @return string barcode 条码
         * @return string number 数量
         * @return string count 价格
         * @return string order_num 订单号
         * @return string other 其他附言
         * @return string discount 减价
         * @return string shopid 商店id
         * @return string storeid 库房id
         * @return string goodname 商品名称
         * @return string time 时间
         * @return string iswarning 报警（库存不报警：NO，报警为负数即表示低于库存警戒值数量）
         */
        public function scanOut() {
            $Domain_Scanin = new Domain_Outflow();
            return $Domain_Scanin->outFlow($this);
        }

    }
    