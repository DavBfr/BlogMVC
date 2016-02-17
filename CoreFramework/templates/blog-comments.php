<section class="comments">
  <h3>Comment this post</h3>
  <div class="alert alert-danger" ng-cloak ng-show="comment_error" ><strong>Oh snap !</strong> you did some errors: {{comment_error}}</div>
  <form name="comment" role="form" ng-submit="save_comment()">
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
          <button type="submit" ng-disabled="comment.$invalid || comment_submitting" class="btn btn-primary">
            <span ng-hide="comment_submitting"><?php $this->tr("core.submit") ?></span>
            <span ng-show="comment_submitting"><?php $this->tr("core.saving") ?></span>
          </button>
      </div>
  </form>

  <h3>{{comments.length}} Comments</h3>

  <div ng-repeat="item in comments">
    <div class="row">
        <div class="col-md-2">
            <img src="http://www.gravatar.com/avatar/{{ item.gid }}?s=100&amp;d=blank" width="100%">
        </div>
        <div class="col-md-10">
            <p><strong>{{item.username}}</strong> {{item.created*1000 | date:'medium'}}</p>
            <p>{{item.content}}</p>
        </div>
    </div>
  </div>
</section>
