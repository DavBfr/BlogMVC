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
									by <a href ng-click="go_user(item.user)">{{item.user}}</a> on <em>{{item.created}}</em>
							</small></p>
					</div>

					<article ng-bind-html="item.content | unsafehtml"/>
					<hr>

					<section class="comments">
							<h3>Comment this post</h3>
							<div class="alert alert-danger" ng-hide="1" ><strong>Oh snap !</strong> you did some errors</div>
							<form name="comment" role="form">
									<div class="row">
											<div class="col-md-6">
													<div ng-class="{'form-group': true, 'has-error':comment.comment_email.$error.email || comment.comment_email.$error.required}">
															<input type="email" ng-required="true" class="form-control" name="comment_email" ng-model="comment_email" placeholder="Your email">
													</div>
											</div>
											<div class="col-md-6">
													<div ng-class="{'form-group': true, 'has-error':comment.comment_user.$error.required}">
															<input type="text" class="form-control" ng-required="true" name="comment_user" ng-model="comment_user" placeholder="Your username">
													</div>
											</div>
									</div>
									<div ng-class="{'form-group': true, 'has-error':comment.comment_content.$error.required}">
											<textarea class="form-control" rows="3" name="comment_content" ng-model="comment_content" ng-required="true" placeholder="Your comment"></textarea>
									</div>
									<div class="form-group">
											<button type="submit" loading-text="<?php $this->tr("core.saving") ?> ..." ng-disabled="comment.$invalid" class="btn btn-primary" ng-click="save_comment()"><?php $this->tr("core.submit") ?></button>
									</div>
							</form>

							<h3>{{comments.length}} Commentaires</h3>

							<div ng-repeat="item in comments">
								<div class="row">
										<div class="col-md-2">
												<img src="http://lorempicsum.com/futurama/100/100/4" width="100%">
										</div>
										<div class="col-md-10">
												<p><strong>{{item.username}}</strong> {{item.created}}</p>
												<p>{{item.content}}</p>
										</div>
								</div>
							</div>
					</section>
			</div>

			<div class="col-md-4 sidebar">
					<?php $this->insert("blog-categories.php"); ?>
					<?php $this->insert("last-posts.php"); ?>
			</div>
	</div>
