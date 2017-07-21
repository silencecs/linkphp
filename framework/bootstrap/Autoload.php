<?php

// +----------------------------------------------------------------------
// | LinkPHP [ Link All Thing ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://linkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liugene <liujun2199@vip.qq.com>
// +----------------------------------------------------------------------
// |               LinkPHP框架自动化加载类
// +----------------------------------------------------------------------

namespace linkphp\bootstrap;
class Autoload
{

    /**
     * 命名空间集合
     */
    static private $_map = [];

    /**
     * 自动加载注册方法
     */
    static public function register($namespace)
    {
        if(is_file(WEB_PATH . 'configure/map.php')){
        static::addNamespace(include(WEB_PATH . 'configure/map.php'));
        }
        if(is_array($namespace)){
            foreach($namespace as $k => $v){
                spl_autoload_register(array(__CLASS__, $v));
            }
        } else {
            spl_autoload_register(array(__CLASS__, $namespace));
        }
    }

    /**
     * 系统自动加载方法
    */
    static public function LinkSystemAutoload($class_name)
    {
        $name = strstr($class_name, '\\', true);
        if($name == 'system'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . SYS;
            /**
             * 判断文件是否存在
             */
            if(file_exists($filename)){
                //存在引入
                //Link系统目录下面的命名空间自动定位
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载系统类");
            }
        }
    }

    /**
     * 核心工具类自动加载方法
     * */
    static public function classMapAutoload($class_name)
    {
        /**
         * 先处理确定的（框架内的核心工具类）
         * 类名与类文件映射数组
         */
        $class_map = static::$_map;
        $linkphp_class_list = $class_map['class_autoload_map'];
        //判断是否为核心工具类
        if(isset($linkphp_class_list[$class_name])){
            //是核心工具类
            require($linkphp_class_list[$class_name]);
        }
    }
    /**
     * 命名空间第三方类库自动加载方法
     * param string $class_name  实例化的类名
     */
    static public function namespaceAutoload($class_name)
    {
        $name = strstr($class_name, '\\', true);
        if($name == 'bootstrap'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //Link核心控制器link目录下面的命名空间自动定位
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载框架核心类");
            }
        }
        /*
         * elseif($name == 'helper'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //系统扩展工具类LinkPHP目录下面的命名空间自动定位
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载框架系统核心扩展类");
            }
        }*/
        /*
         * elseif(in_array($name, array('controllers', 'models'))){
            $filename = EXTEND_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                //扩展控制器模型类LinkPHP 目录下面的命名空间自动定位
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载框架第三方扩展控制器模型类");
            }
        }
        */
        elseif($name == 'util'){
            $filename = LINKPHP_PATH . str_replace('\\', '/', $class_name) . EXT;
            /**
             * 判断文件是否存在
             */
            if(file_exists($filename)){
                //存在引入
                //Link系统目录下面的命名空间自动定位
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception("无法加载工具类");
            }
        }
        /*elseif($name == 'Common'){
            //站点公共控制器模型类
            if(substr($class_name, -10) == 'Controller'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    //判断是否为公共控制器类
                    //控制器类截取后10个匹配Controller
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                } else {
                    //不存在
                    //抛出异常
                    throw new Exception("无法加载框架站点公共控制器类");
                }
            }
            elseif(substr($class_name, -5) == 'Model'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    //判断是否为公共模型类
                    //控制器类截取后5个匹配Model
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
                } else {
                    //不存在
                    //抛出异常
                    throw new Exception("无法加载框架站点公共模型类");
                }
            }
            elseif(substr($class_name,-5) == 'SQLVI'){
                $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . '.SQLVI.php';
                //判断文件是否存在
                if(file_exists($filename)){
                    //存在引入
                    require APPLICATION_PATH . str_replace('\\', '/', $class_name) . '.SQLVI.php';
                } else {
                    //不存在
                    //抛出异常
                    throw new Exception("无法加载框架站点公共数据库视图索引类");
                }
            }
        }*/
    }
    /**
     * 控制器模型类自动加载方法
     */
    /*static public function userAutoload($class_name)
    {
        //判断是否为可增加(控制器类，模型类)
        //控制器类截取后10个匹配Controller
        if(substr($class_name,-10) == 'Controller'){
            //$filename = str_replace('\\', '/', $class_name);
            $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载控制器类");
            }
        }
        elseif(substr($class_name,-5) == 'Model'){
            //$filename = str_replace('\\', '/', $class_name);
            $filename = APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            //判断文件是否存在
            if(file_exists($filename)){
                //存在引入
                require APPLICATION_PATH . str_replace('\\', '/', $class_name) . EXT;
            } else {
                //不存在
                //抛出异常
                throw new \Exception("无法加载模型类");
            }
        }
    }*/

    /*
     * composer自动加载
     * */
    static public function loadExtendAutoload()
    {

        /**
         * 加载Composer自动加载
         */
        require(VENDOR_PATH . 'autoload.php');
        require(LINKPHP_PATH . 'util/sms/drives/alidayu/TopSdk.php');
    }

    /**
     * 注册命名空间名
     */
    static public function addNamespace($namespace)
    {
        return static::$_map = $namespace;
    }

    /**
     * 加载自动类
     */
    static public function loaderClass($class_name)
    {
        $namespace = substr($class_name,0,strrpos($class_name,'\\'));
        if(array_key_exists($namespace,static::$_map['autoload_namespace'])){
            $filename = str_replace('\\', '/', str_replace($namespace,static::$_map['autoload_namespace'][$namespace][0],$class_name)) . EXT;
            if(file_exists($filename)){
                require($filename);
            } else {
                //不存在
                //抛出异常
                throw new Exception('不存在加载类文件');
            }
        } else {
            //不存在
            //抛出异常
            throw new Exception("未注册命名空间");
        }
    }

    /**
     * 查找文件
     */
    static public function findFile()
    {
    }

}
