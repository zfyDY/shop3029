<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	// 设置表名
    public $table = 'users';

    // 配置和用户详情表的一对一关系
    public function usersinfos()
	{
    	return $this->hasOne('App\Models\UsersInfos','uid');
	}
}
