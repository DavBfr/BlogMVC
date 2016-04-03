<ul class="nav navbar-nav navbar-right" data-ng-cloak data-ng-controller="AdminController">

	<li data-ng-show="hasRight('logged')" role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href role="button" aria-haspopup="true" aria-expanded="false">
			{{userdata.username}} <span class="caret"></span>
		</a>
		<ul data-ng-cloak class="dropdown-menu">
			<li data-ng-cloak data-ng-repeat="item in menu" class="{{item.active}}"><a href="#{{item.path}}">{{item.title}}</a></li>
			<li><a href role="button" data-ng-click="logout(true)">Disconnect</a></li>
		</ul>
	</li>
	<li data-ng-hide="hasRight('logged')" role="presentation" class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href role="button" aria-haspopup="true" aria-expanded="false">
			Login <span class="caret"></span>
		</a>
		<div data-ng-cloak class="dropdown-menu loginForm">
			<form role="form">
				<div class="form-group">
					<label for="username">
						<?php $this->tr("core.username") ?>
					</label>
					<input id="username" class="form-control" type="text" autofocus="" data-ng-model="username" placeholder="<?php $this->tr(" core.username ") ?>"/>
				</div>
				<div class="form-group">
					<label for="password">
						<?php $this->tr("core.password") ?>
					</label>
					<input id="password" class="form-control" type="password" data-ng-model="password" placeholder="<?php $this->tr(" core.password ") ?>"/>
				</div>
				<button class="btn btn-primary" data-ng-click="login(username, password, true)">
					<?php $this->tr("core.submit") ?>
				</button>
			</form>
		</div>
	</li>
</ul>
