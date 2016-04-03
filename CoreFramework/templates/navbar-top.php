<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" data-ng-controller="RouteController">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only"><?php $this->tr("core.toggle_navigation") ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#/"><?php $this->out("title") ?></a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php $this->insert("login.php", true); ?>
		</div>
	</div>
</nav>
