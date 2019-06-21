<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 设置表名
    public $table = 'goods';

    // 配置和商品详情表的一对多关系
    // public function usersinfos()
	// {
    	// return $this->hasOne('App\Models\UsersIntos','uid');
	// }
}
