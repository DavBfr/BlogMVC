<div ng-hide="!loading" class="panel panel-default">
	<div class="panel-body">
		<h4 class="text-center">
			<?php $this->tr("core.loading") ?><br>
			<br>
			<img src="<?php echo $this->media("ajax-loader.gif") ?>"/>
		</h4>
	</div>
</div>

	<div ng-cloak class="row">
			<div class="col-md-8">
					<div class="page-header">
							<h1>{{item.name}}</h1>
							<p><small>
									Category : <a href ng-click="go_category(item.category_slug)">{{item.category}}</a>,
									by <a href ng-click="go_user(item.user)">{{item.user}}</a> on <em>{{item.created*1000|date:'medium'}}</em>
							</small></p>
					</div>

					<article ng-bind-html="item.content | unsafehtml"/>
					<?php $this->insert("blog-comments.php", true); ?>
			</div>

			<div class="col-md-4 sidebar">
					<?php $this->insert("blog-categories.php", true); ?>
					<?php $this->insert("last-posts.php"); ?>
			</div>
	</div>
