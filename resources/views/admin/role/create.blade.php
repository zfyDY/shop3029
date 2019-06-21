<!doctype html>
<html lang="en">

<head> 
@include('admin/public/header')

<style>
	.panel-body	h4{color: #666;}
	.auth{margin: 20px;}
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
			<h1 style="vertical-align: inherit;margin:15px;">角色添加</h1>

			<!-- 显示验证错误 开始 -->
			@include('admin/public/error')
			<!-- 显示验证错误 结束 -->

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->


			<form action="/admin/role" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel">
					<div class="panel-body">
						<div>
							<h3><font style="vertical-align: inherit;">角色名称</font></h3>
							<input type="text" name="rname" class="form-control" placeholder="请输入角色名称" value="{{ old('rname') }}">
						</div>
						<div>
							<h3><font style="vertical-align: inherit;">角色权限</font></h3>
							<div class="auth">
								@foreach($list as $k=>$v)
									<h4 style="color:#666;font-weight:bold;">{{ $controller[$k] }} <small>({{$k}})</small></h4>
									@foreach($v as $kk=>$vv)
										@if($vv['id'] == 1)
										<label class="fancy-checkbox" style="display:inline-block;"><input type="checkbox" checked="" name="nids[]" value="{{$vv['id']}}"><span>{{ $vv['desc'] }}</span></label>
										@else
										<label class="fancy-checkbox" style="display:inline-block;"><input type="checkbox" name="nids[]" value="{{$vv['id']}}"><span>{{ $vv['desc'] }}</span></label>
										@endif
									@endforeach
								@endforeach
							</div>
							
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
