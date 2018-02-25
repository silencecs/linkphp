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
// |               中间件配置文件
// +----------------------------------------------------------------------

return [

    'beginMiddleware'          => [
        \app\controller\main\Index::class,
        \app\controller\main\Test::class,
        \app\controller\main\First::class,
    ],

    'appMiddleware'            => [],

    'modelMiddleware'          => [],

    'controllerMiddleware'     => [],

    'actionMiddleware'         => [],

    'destructMiddleware'       => [],

];