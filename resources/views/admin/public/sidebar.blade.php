<style>
	
</style>
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav reg">
				<!-- 用户管理 -->
				<li>
					<a href="#Users" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-user"></i> <span>用户管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="Users" class="collapse ">
						<ul class="nav">
							<!-- 前台用户 -->
							<li>
								<a href="#HomeUsers" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-text-color"></i> <span>前台用户</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="HomeUsers" class="collapse ">
									<ul class="nav">
										<li><a href="/admin/user" class="">用户列表</a></li>
										<li><a href="/admin/user/create" class="">用户添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 管理员 -->
							<li>
								<a href="#AdminUsers" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-text-background"></i> <span>后台管理员</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="AdminUsers" class="collapse ">
									<ul class="nav">
										<li><a href="/admin/adminuser" class="">管理员列表</a></li>
										<li><a href="/admin/adminuser/create" class="">管理员添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 管理员角色 -->
							<li>
								<a href="#Roles" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-superscript"></i> <span>角色管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="Roles" class="collapse ">
									<ul class="nav">
										<li><a href="/admin/role" class="">角色列表</a></li>
										<li><a href="/admin/role/create" class="">角色添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 权限管理 -->
							<li>
								<a href="#R" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-subscript"></i> <span>权限管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="R" class="collapse ">
									<ul class="nav">
										<li><a href="/admin/node" class="">权限列表</a></li>
										<li><a href="/admin/node/create" class="">权限添加</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</li>
				<!-- 栏目管理 -->
				<li>
					<a href="#CatesInfos" data-toggle="collapse" class="collapsed"><i class="fa fa-calendar"></i> <span>栏目管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="CatesInfos" class="collapse ">
						<ul class="nav">
							<li><a href="/admin/cate" class="">栏目列表</a></li>
							<li><a href="/admin/cate/create" class="">栏目添加</a></li>
						</ul>
					</div>
				</li>
				<!-- 商品管理 -->
				<li>
					<a href="#Goods" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cart"></i> <span>商品管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="Goods" class="collapse ">	
						<ul class="nav">
							<!-- 商品管理 -->
							<li>
								<a href="#Good" data-toggle="collapse" class="collapsed"><i class="lnr lnr-cart"></i> <span>商品管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="Good" class="collapse ">	
									<ul class="nav">
										<li><a href="/admin/good" class="">商品列表</a></li>
										<li><a href="/admin/good/create" class="">商品添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 商品规格 -->
							<li>
								<a href="#GoodsSpu" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-th-list"></i> <span>商品规格</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="GoodsSpu" class="collapse ">	
									<ul class="nav">
										<li><a href="/admin/goodspu" class="">规格列表</a></li>
										<li><a href="/admin/goodspu/create" class="">规格添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 商品规格值 -->
							<li>
								<a href="#GoodsAttr" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-th"></i> <span>商品规格值</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="GoodsAttr" class="collapse ">	
									<ul class="nav">
										<li><a href="" class="">规格值列表</a></li>
										<li><a href="" class="">规格值添加</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</li>
				
				<!-- 轮播图管理 -->
				<li>
					<a href="#Banners" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-picture"></i> <span>轮播图管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="Banners" class="collapse ">	
						<ul class="nav">
							<li><a href="/admin/banner/" class="">轮播图列表</a></li>
							<li><a href="/admin/banner/create" class="">轮播图添加</a></li>
						</ul>
					</div>
				</li>
				<!-- 广告管理 -->
				<li>
					<a href="#Adves" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-bullhorn"></i> <span>广告管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
					<div id="Adves" class="collapse ">	
						<ul class="nav">
							<!-- 广告位管理 -->
							<li>
								<a href="#Adve" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-edit"></i> <span>广告位管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="Adve" class="collapse ">	
									<ul class="nav">
										<li><a href="/admin/adve/" class="">广告位列表</a></li>
										<li><a href="/admin/adve/create" class="">广告位添加</a></li>
									</ul>
								</div>
							</li>
							<!-- 友情链接管理 -->
							<li>
								<a href="#Links" data-toggle="collapse" class="collapsed"><i class="glyphicon glyphicon-share"></i> <span>友情链接管理</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="Links" class="collapse ">	
									<ul class="nav">
										<li><a href="/admin/link/" class="">友情链接列表</a></li>
										<li><a href="/admin/link/create" class="">友情链接添加</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</nav>
	</div>
</div>