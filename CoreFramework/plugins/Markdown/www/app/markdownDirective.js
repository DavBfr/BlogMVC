
app.directive('ngMarkdown', [function() {
	return {
		restrict: 'EA',
		require: '?ngModel',
		link: function(scope, elem, attrs, ngModel) {
			var simplemde = new SimpleMDE({ element: elem.context,
				toolbar: ["bold", "italic", "heading", "|", "code", "quote", "unordered-list",
								"ordered-list",
								"clean-block",
								"link",
								"image",
								"table",
								"horizontal-rule",
								"|",
								"preview"
],
			});
			simplemde.codemirror.on("change", function(instance) {
				var newValue = instance.getValue();
 				if (newValue !== ngModel.$viewValue) {
	 				scope.$evalAsync(function() {
		 				ngModel.$setViewValue(newValue);
	 				});
 				}
			});
			ngModel.$render = function() {
	      var safeViewValue = ngModel.$viewValue || '';
	      simplemde.value(safeViewValue);
			};
		}
	};
}]);
