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
			<h1 style="vertical-align: inherit;margin:15px;">添加商品规格属性</h1>

			<!-- 显示验证错误 开始 -->
			@include('admin/public/error')
			<!-- 显示验证错误 结束 -->

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->


			<form action="/admin/detail" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel">
					<div class="panel-body">
						<div>
							<h4><font style="vertical-align: inherit;">选择商品规格</font></h4>
							<input type="text" name="gname" class="form-control" placeholder="请输入商品名" value="{{ old('gname') }}">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">商品属性</font></h4>
							<!-- <input type="text" name="title" class="form-control" placeholder="请输入标题" value="{{ old('title') }}"> -->
							<select name="color" id="" class="form-control">
								<option value="red">红色</option>
								<option value="yellow">黄色</option>
								<option value="blue">蓝色</option>
								<option value="green">绿色</option>
							</select>
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">商品价格</font></h4>
							<input type="text" name="price_min" class="form-control" placeholder="请输入商品价格" value="{{ old('price_min') }}">
						</div>
						<br>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:70px;float:left;margin:5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">添加</font></font></button>
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
