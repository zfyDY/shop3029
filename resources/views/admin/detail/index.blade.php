<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#hidden{overflow:hidden;
    	text-overflow:ellipsis;
    	white-space:nowrap;}
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
			<h1 style="vertical-align: inherit;margin:15px;">此处显示相应的商品</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/good" method="get"> 
						<div class="form-group"> 
							<label for="price">商品价格&nbsp;</label> 
							<input type="text" class="form-control" name="search_gname" value="{{ $params['search_gname'] or '' }}" id="gname" placeholder="商品价格">&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="title">商品规格&nbsp;</label> 
							<input type="text" class="form-control" name="search_title" value="{{ $params['search_title'] or '' }}" id="title" placeholder="商品规格"> &nbsp;&nbsp;&nbsp;&nbsp;
							<label for="cate">商品属性&nbsp;</label> 
							<input type="text" class="form-control" name="search_cate" value="{{ $params['search_cate'] or '' }}" id="cate" placeholder="商品属性"> &nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info">
						<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示商品详情</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>商品ID</th>
						<th>商品名称</th>
						<th>规格</th>
						<th>属性</th>
						<th>价格</th>
						<th>库存</th>
						<th>操作</th>
					</tr>
				</table>

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					
				</div>
				<!-- 显示分页结束 -->
			</div>
			<!-- 显示 用户列表 结束 -->

			<!-- 添加 商品 属性 开始 -->
			<a href="/admin/detail/create/{{$id}}" class="btn btn-warning">添加属性</a>
			<!-- 添加 商品 属性 结束 -->
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
