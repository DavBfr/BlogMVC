<h4>Last posts</h4>
<div class="list-group" ng-controller="BlogController">
	<a href ng-click="go_detail(item.slug)" class="list-group-item" data-ng-repeat="item in list">
		{{item.name}}
	</a>
</div>
