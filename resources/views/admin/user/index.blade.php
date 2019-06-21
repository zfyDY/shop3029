<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
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
			<h1 style="vertical-align: inherit;margin:15px;">用户列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/user" method="get"> 
						<div class="form-group"> 
							<label for="uname">姓名&nbsp;</label> 
							<input type="text" class="form-control" name="search_uname" value="{{ $params['search_uname'] or '' }}" id="uname" placeholder="用户名">&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="email">邮箱&nbsp;</label> 
							<input type="text" class="form-control" name="search_email" value="{{ $params['search_email'] or '' }}" id="email" placeholder="邮箱"> &nbsp;&nbsp;&nbsp;&nbsp;
							<label for="phone">手机号&nbsp;</label> 
							<input type="text" class="form-control" name="search_phone" value="{{ $params['search_phone'] or '' }}" id="phone" placeholder="手机号"> &nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info">
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
						<th>用户ID</th>
						<th>用户名</th>
						<th>头像</th>
						<th>邮箱</th>
						<th>手机号</th>
						<th>操作</th>
					</tr>
					@foreach($users as $k=>$v)
					<tr align="center">
						<th style="line-height:58px;">{{ $v->id }}</th>
						<td style="line-height:58px;">{{ $v->uname }}</td>
						<td>
							<img src="/uploads/{{ $v->usersinfos->profile }}" class="img-thumbnail" style="width:80px;" alt="">
						</td>
						<td style="line-height:58px;">{{ $v->email }}</td>
						<td style="line-height:58px;">{{ $v->phone }}</td>
						<td style="line-height:58px;width:200px;">
							<!-- <form action="" method="get">
								<input type="submit" value="修改" class="btn btn-info">
							</form> -->
							<a href="/admin/user/{{ $v->id }}/edit" class="btn btn-info">修改</a>

							<form action="/admin/user/{{$v->id}}" method="post" style="display:inline-block;">
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
					{{ $users->appends($params)->links() }}
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
