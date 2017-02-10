<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
function deepScanDir($dir)
{
    $dirArr = array();
    $dir = rtrim($dir, '\/');
    if(is_dir($dir)){
        $dirHandle = opendir($dir);
        while(false !== ($fileName = readdir($dirHandle))){
            $subFile = $dir . DIRECTORY_SEPARATOR . $fileName;
            if(is_dir($subFile) && str_replace('.', '', $fileName)!=''){
                $subFile = str_replace(APP_PATH . 'addones'.DS,'',$subFile);
                $dirArr[] = $subFile;
            }
        }
        closedir($dirHandle);
    }
    return $dirArr;
}