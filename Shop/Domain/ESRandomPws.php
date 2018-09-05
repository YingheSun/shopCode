<?php

    class Domain_ESRandomPws {

        public function randpw($len , $format) {
            $is_abc   = $is_numer = 0;
            $password = $tmp      = '';
            unset($password);
            unset($tmp);
            switch ($format) {
                case 'ALL':
                    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    break;
                case 'CHAR':
                    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    break;
                case 'NUMBER':
                    $chars = '0123456789';
                    break;
                default :
                    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    break;
            } // www.jb51.net
//            mt_srand((double) microtime() * 1000000 * getmypid());
            while (strlen($password) < $len) {
                $tmp = substr($chars , (mt_rand() % strlen($chars)) , 1);
                if (($is_numer <> 1 && is_numeric($tmp) && $tmp > 0 ) || $format == 'CHAR') {
                    $is_numer = 1;
                }
                if (($is_abc <> 1 && preg_match('/[a-zA-Z]/' , $tmp)) || $format == 'NUMBER') {
                    $is_abc = 1;
                }
                $password.= $tmp;
            }
            if ($is_numer <> 1 || $is_abc <> 1 || empty($password)) {
                $password = randpw($len , $format);
            }
            return $password;
        }

    }
    