
app.directive('ngMarkdown', [function() {
	return {
		restrict: 'EA',
		require: '?ngModel',
		link: function(scope, elem, attrs, ngModel) {
			var simplemde = new SimpleMDE({
				element: elem[0],
				//toolbar: ["bold", "italic", "heading", "|", "code", "quote", "unordered-list", "ordered-list", "clean-block", "link", "image", "horizontal-rule", "|", "preview"],
				hideIcons: ["side-by-side", "fullscreen", "guide"],
				placeholder: attrs.placeholder || '',
				spellChecker: false
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
				scope.$evalAsync(function() {
      		simplemde.value(safeViewValue);
				});
			};
		}
	};
}]);
