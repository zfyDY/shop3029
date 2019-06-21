<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#search{position: relative;top: -9px;}
</style> 
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- 导航栏 开始 -->
		@include('admin/public/navber')
		<!-- 导航栏 结束 -->
		
		<!-- 后台 左侧边栏 开始 -->
		@include('admin/public/sidebar')
		<!-- 后台 左侧边栏 结束 -->


		<!-- 后台 首页 主体 开始 -->
		<div class="main">
			<h1 style="vertical-align: inherit;margin:15px;">管理员列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/adminuser" method="get"> 
						<div class="form-group"> 
							<label for="uname">管理员&nbsp;</label> 
							<input type="text" class="form-control" name="search_uname" value="{{ $params['search_uname'] or '' }}" id="uname" placeholder="管理员">&nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info" id="search">
						<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示用户详情</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>管理员</th>
						<th>头像</th>
						<th>角色</th>
						<th>操作</th>
					</tr>
					@foreach($admin_user as $k=>$v)
					<tr align="center">
						<th style="line-height:85px;">{{ $v->id }}</th>
						<td style="line-height:85px;">{{ $v->uname }}</td>
						<td>
							<img src="/uploads/{{ $v->profile }}" class="img-thumbnail" style="width:120px;" alt="">
						</td>
						<td style="line-height:85px;">{{ $temp[ $data[$v->id] ] }}</td>
						<td style="line-height:85px;width:250px;">
							<a href="/admin/adminuser/{{ $v->id }}/edit" class="btn btn-info">修改角色</a>
							<form action="/admin/adminuser/{{$v->id}}" method="post" style="display:inline-block;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<input type="submit" value="删除" class="btn btn-danger">
							</form>
						</td>
					</tr>
					@endforeach
				</table>

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					{{ $admin_user->appends($params)->links() }}
				</div>
				<!-- 显示分页结束 -->
			</div>
			<!-- 显示 用户列表 开始 -->
		</div>
		<!-- 后台 首页 主体 结束 -->

		<div class="clearfix"></div>
		
		<!-- 页脚 开始 -->
		@include('admin/public/footer')
		<!-- 页脚 结束 -->

	</div>
	<!-- END WRAPPER -->
	
	<!-- JavaScript 开始 -->
	@include('admin/public/script')
	<!-- JavaScript 结束 -->

</body>

</html>
