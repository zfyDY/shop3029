<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	echo '<h1>233333</h1>';
    return view('welcome');
});


// 后台 登录界面 路由
Route::get('admin/login','Admin\LoginController@index');	

// 后台执行登录操作路由
Route::post('admin/dologin','Admin\LoginController@dologin');

// 后台执行退出登录 路由
Route::get('admin/loginout','Admin\LoginController@loginout');		

// 后台显示 没有权限访问 页面 路由
Route::get('admin/index/rbac',function(){
	return view('admin/index/rbac');
});

Route::group(['middleware'=>['admin_login','admin_nodes']],function(){
	// 后台 首页
	Route::get('admin', 'Admin\IndexController@index');
	// 后台 用户
	Route::resource('admin/user', 'Admin\UserController');
	// 后台 栏目分类
	Route::resource('admin/cate', 'Admin\CateController');

	// 轮播图激活状态路由
	Route::get('admin/banner/wakeUp','Admin\BannerController@wakeUp');
	// 后台 轮播图
	Route::resource('admin/banner', 'Admin\BannerController');

	//-----------------------------------------------------------------

	// 商品激活状态路由
	Route::get('admin/good/wakeUp/{id}','Admin\GoodController@wakeUp');
	// 商品管理
	Route::resource('admin/good', 'Admin\GoodController');

	// 商品规格路由
	Route::resource('admin/goodspu', 'Admin\GoodSpuController');

	// 商品详情页面路由
	Route::get('admin/detail/index/{id}','Admin\DetailController@index');
	Route::get('admin/detail/create/{id}','Admin\DetailController@create');

	// 商品详情
	Route::resource('admin/detail', 'Admin\DetailController');

	//-----------------------------------------------------------------

	// 激活友情链接
	Route::get('admin/link/wakeUp','Admin\LinkController@wakeUp');
	// 友情链接路由
	route::resource('admin/link','Admin\LinkController');

	// 激活广告
	Route::get('admin/adve/wakeUp','Admin\AdveController@wakeUp');
	// 广告位的路由
	route::resource('admin/adve','Admin\AdveController');

	// ------------------------------------------------------------------

	// 后台 管理员 路由
	Route::resource('admin/adminuser', 'Admin\AdminuserController');

	// 后台 角色 路由
	Route::resource('admin/role', 'Admin\RoleController');
	
	// 后台 权限 路由
	Route::resource('admin/node', 'Admin\NodeController');
	
});

