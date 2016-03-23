<h4>Categories</h4>
<div class="list-group" ng-controller="CatController">
	<a href data-ng-click="go_category(item.slug)" data-ng-repeat="item in list" class="list-group-item">
		<span class="badge">{{item.post_count}}</span>
		{{item.name}}
	</a>
</div>
