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
			<h1 style="vertical-align: inherit;margin:15px;">权限列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/node" method="get"> 
						<div class="form-group"> 
							<label for="desc">权限名称&nbsp;</label> 
							<input type="text" class="form-control" name="search_desc" value="{{ $params['search_desc'] or '' }}" id="desc" placeholder="权限名称">&nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<div class="form-group"> 
							<label for="cname">控制器名称&nbsp;</label> 
							<input type="text" class="form-control" name="search_cname" value="{{ $params['search_cname'] or '' }}" id="cname" placeholder="控制器名称">&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<div class="form-group"> 
							<label for="aname">方法名称&nbsp;</label> 
							<input type="text" class="form-control" name="search_aname" value="{{ $params['search_aname'] or '' }}" id="aname" placeholder="方法名称">&nbsp;&nbsp;&nbsp;&nbsp;
						</div>
						<input type="submit" value="搜索" class="btn btn-info" id="search">
						<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示权限详情</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>ID</th>
						<th>权限名称</th>
						<th>控制器名称</th>
						<th>方法名称</th>
						<th>操作</th>
					</tr>
					@foreach($nodes as $k=>$v)
					<tr align="center">
						<th style="line-height:58px;">{{ $v->id }}</th>
						<td style="line-height:58px;">{{ $v->desc }}</td>
						<td style="line-height:58px;">{{ $v->cname }}</td>
						<td style="line-height:58px;">{{ $v->aname }}</td>
						<td style="line-height:58px;width:200px;">
							<a href="/admin/node/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/node/{{$v->id}}" method="post" style="display:inline-block;">
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
					{{ $nodes->appends($params)->links() }}
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
