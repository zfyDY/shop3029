<?php

namespace App\Http\Middleware;
  
use Closure;

class NodesMiddleware
{
    /**
     * 设置登录用户的权限
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 获取 session 保存的权限 (登录用户)
        $nodes = session('all_nodes');

        // 获取所有可以操作的控制器
        $controller_all = array_keys($nodes);

        // 获取当前正在 操作的控制器和方法名称
        $actions=explode('\\', \Route::current()->getActionName());
        //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
        $func=explode('@', $actions[count($actions)-1]);
        $controllerName=$func[0];
        $actionName=$func[1];

        // 判断当前操作的控制器在不在允许权限范围内
        if(!in_array($controllerName, $controller_all)){
            return redirect('admin/index/rbac');
            exit;
        }

        // 以当前操作的控制器为下标获取 这个控制器中允许访问的方法
        $action_all = $nodes[$controllerName];
         if(!in_array($actionName, $action_all)){
            return redirect('admin/index/rbac');
            exit;
        }

        return $next($request);
    }
}
