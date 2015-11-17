{* Display a variable directly *}
<div>
	<h3>Windowsill ({$url})</h3>
	{$error}
	<hr>
  <!-- http://stackoverflow.com/questions/12738012/smarty-php-clashing-with-angularjs -->
	<div ng-app="angularjs-windowsill">
      <div ng-controller="mainCtrl">
          
      <h1>WindowSill: Settings</h1>
      
      <!-- EMPTY FIELDS -->
      <div class="alert alert-warning" role="alert" ng-show="!mainGroup.$valid">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span><span>Empty fields can't be submitted</span>
      </div>
      
      <!-- DUPLICATE -->
      <div class="alert alert-danger" role="alert" ng-show="mainGroup.$error.duplicate">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span><span>Duplicate fields can't be submitted</span>
      </div>
      
      <!-- CHOICES -->
      <div ng-form="mainGroup">
        <div ng-repeat="choice in choices">
          <div class="form-group"> 
      
            <div class="input-group" ng-class="{literal}{'has-error': mainGroup.n[[$index]].$invalid || mainGroup.v[[$index]].$invalid }{/literal}">
              
              <label for="n[[$index]]" class="input-group-addon">Name</label>
              <input type="text" class="form-control" name="n[[$index]]" id="n[[$index]]" ng-model="choice.name" ng-pattern="/^[a-zA-Z0-9 ]*$/" placeholder="name" checkunique required>
      
              <label for="v[[$index]]" class="input-group-addon">View</label>
              <select class="form-control" name="v[[$index]]" id="v[[$index]]" ng-model="choice.view" required>
                <option ng-repeat="view in views" value="[[view.id]]">[[view.name]]</option>
              </select>
            
              <span class="input-group-addon">
                <input type="checkbox" class="" id="tab_[[$index]]" ng-model="choice.tab"> 
                <label for="tab_[[$index]]" translate>Tab</label>
              </span>
              
              <span class="input-group-addon">
                <input type="checkbox" class="" id="token_[[$index]]" ng-model="choice.token">
                <label for="token_[[$index]]">Token</label>
              </span>
              
            </div>
            
            <span ng-show="mainGroup.n[[$index]].$invalid && !mainGroup.n[[$index]].$pristine" class="text-danger">
            Name is a required, unique field that can only contain [a-z],[A-Z],[0-9] & space characters.</span>
        	
            <div ng-show="!$first && $last">
              <a ng-click="removeChoice($index)" name="remove" class="label label-danger">
                <span class="glyphicon glyphicon glyphicon-remove"></span><span>remove</span>
              </a>
            </div>
        
            <div ng-show="$last">
              <a ng-click="newChoice()" name="add" class="label label-default">
                <span class="glyphicon glyphicon-circle-arrow-down">add</span>
              </a>
            </div>
            
          </div>
        </div>
      </div>
      
      <!-- FORM SUBMIT -->
      <form action="{$url}" method="post">
      	<input type="hidden" name="settings" value="[[choices]]">
        <div class="crm-submit-buttons" ng-show="mainGroup.$valid"><span class="crm-button"><input class="crm-form-submit default" type="submit" value="Submit"></span></div>
      </form>
      
      <pre>[[choices]]</pre>  
      
      </div>
  </div>
  
</div>