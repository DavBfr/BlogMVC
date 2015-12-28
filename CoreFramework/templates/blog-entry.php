<div data-ng-hide="!loading" class="panel panel-default">
	<div class="panel-body">
		<h4 class="text-center">
			<?php $this->tr("core.loading") ?><br>
			<br>
			<img src="<?php echo $this->media("ajax-loader.gif") ?>"/>
		</h4>
	</div>
</div>

	<div data-ng-cloak class="row">
			<div class="col-md-8">
					<div class="page-header">
							<h1>{{item.name}}</h1>
							<p><small>
									Category : <a href data-ng-click="go_category(item.category_slug)">{{item.category}}</a>,
									by <a href data-ng-click="go_user(item.user)">{{item.user}}</a> on <em>{{item.created}}</em>
							</small></p>
					</div>

					<article ng-bind-html="item.content | unsafehtml"/>
					<hr>

					<section class="comments">

							<h3>Comment this post</h3>

							<div class="alert alert-danger"><strong>Oh snap !</strong> you did some errors</div>

							<form role="form">
									<div class="row">
											<div class="col-md-6">
													<div class="form-group">
															<input type="email" class="form-control" placeholder="Your email">
													</div>
											</div>
											<div class="col-md-6">
													<div class="form-group has-error">
															<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Your username">
													</div>
											</div>
									</div>
									<div class="form-group">
											<textarea class="form-control" rows="3" placeholder="Your comment"></textarea>
									</div>
									<div class="form-group">
											<button type="submit" class="btn btn-primary">Submit</button>
									</div>
							</form>

							<h3>2 Commentaires</h3>

							<div class="row">
									<div class="col-md-2">
											<img src="http://lorempicsum.com/futurama/100/100/4" width="100%">
									</div>
									<div class="col-md-10">
											<p><strong>Username</strong> 10 hours ago</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, laudantium voluptatibus quae doloribus dolorem earum dicta quasi. Fugit, eligendi, voluptatibus corporis deleniti perferendis accusantium totam harum dolor ab veniam laudantium!</p>
									</div>
							</div>
							<div class="row">
									<hr>
									<div class="col-md-2">
											<img src="http://lorempicsum.com/futurama/100/100/5" width="100%">
									</div>
									<div class="col-md-10">
											<p><strong>Username</strong> 11 days ago</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, laudantium voluptatibus quae doloribus dolorem earum dicta quasi. Fugit, eligendi, voluptatibus corporis deleniti perferendis accusantium totam harum dolor ab veniam laudantium!</p>
									</div>
							</div>
					</section>



			</div>

			<div class="col-md-4 sidebar">

					<h4>Categories</h4>
					<div class="list-group">
							<a href="category.html" class="list-group-item">
									<span class="badge">14</span>
									Category #1
							</a>
							<a href="category.html" class="list-group-item">
									<span class="badge">5</span>
									Category #2
							</a>
							<a href="category.html" class="list-group-item">
									<span class="badge">1</span>
									Category #3
							</a>
							<a href="category.html" class="list-group-item">
									<span class="badge">7</span>
									Category #4
							</a>
					</div>

					<h4>Last posts</h4>
					<div class="list-group">
							<a href="post.html" class="list-group-item">
									The Route of All Evil
							</a>
							<a href="post.html" class="list-group-item">
									Good news everyone !
							</a>
					</div>
			</div><!-- /.sidebar -->
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default" data-ng-click="go_list()"><?php $this->tr("core.close") ?></button>
		</div>
	</div>
	
