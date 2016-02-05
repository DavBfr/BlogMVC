<div class="row">
	<div class="col-md-8">

		<div class="page-header">
			<h1><?php echo $this->config("title") ?></h1>
			<p class="lead"><?php echo $this->config("description", "tr") ?></p>
		</div>

		<div data-ng-hide="!loading" class="panel panel-default">
			<div class="panel-body">
				<h4 class="text-center">
					<?php $this->tr("core.loading") ?><br>
					<br>
					<img src="<?php echo $this->media("ajax-loader.gif") ?>"/>
				</h4>
			</div>
		</div>

		<div data-ng-cloak data-ng-hide="count > 0 || loading" class="well">
			<?php $this->tr("core.none_found") ?>
		</div>

		<div data-ng-cloak data-ng-hide="count == 0 || loading">
			<div data-ng-repeat="item in list">
				<article>
					<h2><a href data-ng-click="go_detail(item.slug)">{{item.name}}</a></h2>
					<p>
						<small>
							Category : <a href="category.html">Nature</a>, by <a href="index.html">John Doe</a> on
							<em>{{item.created}}</em>
						</small>
					</p>
					<p ng-bind-html="item.content | unsafehtml"/>
					<p class="text-right">
						<button data-ng-click="go_detail(item.slug)" type="button" class="btn btn-primary">
							Read more...
						</button>
					</p>
				</article>
				<hr>
			</div>
		</div>

		<ul data-ng-hide="pages <= 1" class="pagination pull-left">
			<li data-ng-class="page == 0?'disabled':''">
				<a data-ng-click="setPage(page - 1)" href="">&laquo;</a>
			</li>
			<li data-ng-class="$index == page?'active':''" data-ng-repeat="i in getPages() track by $index">
				<a data-ng-click="setPage($index)" href="">{{$index+1}}</a>
			</li>
			<li data-ng-class="page == pages -1?'disabled':''">
				<a data-ng-click="setPage(page + 1)" href="">&raquo;</a>
			</li>
		</ul>
	</div>

	<div class="col-md-4 sidebar">
		<?php $this->insert("blog-categories.php"); ?>
		<h4>Last posts</h4>
		<div class="list-group">
			<a href="post.html" class="list-group-item">
										The Route of All Evil
								</a>
			<a href="post.html" class="list-group-item">
										Good news everyone !
								</a>
		</div>
	</div>
	<!-- /.sidebar -->
</div>
