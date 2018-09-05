<?php

    /**
     * 商品入库接口服务类
     * @author: YHS 20160603
     */
    class Api_ESScanIn extends PhalApi_Api {

        public function getRules() {
            return array(
                //扫码入库
                'scanIn' => array(
                    'barcode' => array(
                        'name'    => 'barcode' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'min'     => 13 ,
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
                    'reqid'   => array(
                        'name'    => 'reqid' ,
                        'type'    => 'string' ,
                        'require' => true ,
                        'desc'    => '请求者id') ,
                ) ,
            );
        }

        /**
         * 商品入库订单处理(使用,1.0,OK)
         * 20160722 1.0
         * @desc code：111扫码频率太快，上一次请求还未完成 扫码入库功能
         * @return string total 总钱数
         * @return string linecount 总行数
         * @return string other1 其他1
         * @return string other2 其他2
         * @return list retlist
         * @return string id 编号
         * @return string barcode 条码
         * @return string number 数量
         * @return string price 单品价格
         * @return string count 单品总计价格
         * @return string seral_id 订单号
         * @return string goodname 商品名称
         * @return string other 其他附言
         * @return string time 时间
         * @return list retlist
         */
        public function scanIn() {
            $Domain_Scanin = new Domain_Inflow();
            return $Domain_Scanin->inFlow($this);
        }

    }
    