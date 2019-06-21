<!doctype html>
<html lang="en">

<head>
@include('admin/public/header')

<style>
	.panel-body	h4{color: #666;}
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
			<h1 style="vertical-align: inherit;margin:15px;">管理员添加</h1>

			<!-- 显示验证错误 开始 -->
			@include('admin/public/error')
			<!-- 显示验证错误 结束 -->

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->


			<form action="/admin/adminuser" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel">
					<div class="panel-body">
						<div>
							<h4><font style="vertical-align: inherit;">管理员</font></h4>
							<input type="text" name="uname" class="form-control" placeholder="请输入管理员名称" value="{{ old('uname') }}">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">密码</font></h4>
							<input type="password" name="upwd" class="form-control" placeholder="请输入密码">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">确认密码</font></h4>
							<input type="password" name="reupwd" class="form-control" placeholder="请确认密码">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">角色名称</font></h4>
							<select name="rid" id="" class="form-control">
								<option value="">--请选择角色--</option>
								@foreach($roles as $k=>$v)
								<option value="{{$v->id}}">{{$v->rname}}</option>
								@endforeach
							</select>
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">头像</font></h4>
							<input type="file" name="profile" class="form-control">
						</div>
						<br>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:70px;float:left;margin:5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加</font></font></button>
							<button type="reset"  class="btn btn-danger" style="width:70px;float:left;margin:5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">重置</font></font></button>
						</div>
					</div>
				</div>
			</form>
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
