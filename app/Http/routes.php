<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (){
	// 加载视图里面welcome 视图目录resources/views/welcome.blade.php
    return view('welcome');
    /*=========获取配置信息=====*/
    echo date('Y-m-d h:i:s');
    echo Config::get('app.timezone');
    echo Config::get('app.url');
    echo Config::get('app.locale');

    /*========设置配置信息======*/
    // 自定义数组对象中的属性
    Config::set('app.timezone','UTC');
    echo Config::get('app.timezone');
    //自定义数组对象中的属性
    echo Config::get('app.webname');
    echo env('DB_CONNECTION');
});
/*==============路由的基本操作=========*/
Route::get('/test',function(){
	echo '111';
});

Route::get('/tests/add',function(){
	echo '2222';
});


Route::post('/user/add',function(){
	echo 'qqq';
});

Route::get('/form',function(){
	return view('form');
});

/*==========带参数的路由=========*/
Route::get('/shop/{id}',function($id){
	echo "商品id是".$id;
})->where('id','\d+');

Route::get('/shops/{name}',function($name){
	echo "商品name是".$name;
})->where('name','[a-z A-Z]+');

/*==========多个参数的路由========*/
// 1.多个参数以-为分隔符
Route::get('shopss/{id}-{name}',function($id,$name){
	echo "商品的id是".$id;
	echo "商品的名字是".$name;
})->where('id','\d+')->where('name','[a-z A-Z]+');

//2.给路由起别名
Route::get('/admin/user/add',['as'=>'uadd',function(){
			echo 'sss';
}]);

Route::get('/test',function(){
	echo route('uadd');//路由函数route去获取别名或者是路由规则
});

// 3.路由组的设置
Route::group(['middleware'=>'login'],function(){

	//路由
	Route::get('/home/order',function(){
		echo '我是前台的订单页面';
	});

	Route::get('/admin/user/edit',function(){
		echo '这是后台用户的修改';
	});

});

Route::get('/ss',function(){
	abort('404');
});

Route::get('/ajax',function(){
	return view('ajax');
});

Route::post('/post',function(){
	echo "接收ajax的响应数据";
});

Route::get('/login',function(){
	echo "这是用户的登录界面";
});
Route::get('/home/person',function(){
	echo '这是前台的个人中心';
})->middleware('login');
