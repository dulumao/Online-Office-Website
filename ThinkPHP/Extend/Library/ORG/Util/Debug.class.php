<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * 系统调试类
 * @category   Think
 * @package  Think
 * @subpackage  Util
 * @author    liu21st <liu21st@gmail.com>
 */
class Debug {

    static private $marker =  array();
    /**
     * 标记调试位
     * @access public
     * @param string $name  要标记的位置名称
     * @return void
     */
    static public function mark($name) {
        self::$marker['time'][$name]  =  microtime(TRUE);
        if(MEMORY_LIMIT_ON) {
            self::$marker['mem'][$name] = memory_get_usage();
            self::$marker['peak'][$name] = function_exists('memory_get_peak_usage')?memory_get_peak_usage(): self::$marker['mem'][$name];
        }
    }

    /**
     * 区间使用时间查看
     * @access public
     * @param string $start  开始标记的名称
     * @param string $end 