{* Display a variable directly *}
<div class="crm-block crm-form-block">
	<h3>Windowsill ({$url})</h3>
	{$error}
	<table>
  		<tr>
    		<td>
			{$content}
  			</tr>
  		</tr>
  	</table>
	<hr>
    
	<div ng-app="angularjs-windowsill">
      <div ng-controller="mainCtrl">
          
      <h1>WindowSill: Settings</h1>
      
      <!-- ALERT -->
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
      
            <div class="input-group" ng-class="{'has-error': mainGroup.n{{$index}}.$invalid || mainGroup.v{{$index}}.$invalid }">
              
              <label for="n{{$index}}" class="input-group-addon">Name</label>
              <input type="text" class="form-control" name="n{{$index}}" id="n{{$index}}" ng-model="choice.name" placeholder="name" checkunique required>
      
              <label for="v{{$index}}" class="input-group-addon">View</label>
              <select class="form-control" name="v{{$index}}" id="v{{$index}}" ng-model="choice.view" required>
                <option ng-repeat="view in views" value="{{view.id}}">{literal}{{view.name}}{/literal}</option>
              </select>
            
              <span class="input-group-addon">
                <input type="checkbox" class="" id="tab_{{$index}}" ng-model="choice.tab"> 
                <label for="tab_{{$index}}" translate>Tab</label>
              </span>
              
              <span class="input-group-addon">
                <input type="checkbox" class="" id="token_{{$index}}" ng-model="choice.token">
                <label for="token_{{$index}}">Token</label>
              </span>
              
            </div>
            
            <span ng-show="mainGroup.n{{$index}}.$invalid && !mainGroup.n{{$index}}.$pristine" class="text-danger">
            Name is a required, unique field that can only contain [a_z,0-9] characters.</span>
        	
            <div ng-show="!$first && $last">
              <a ng-click="removeChoice($index)" name="remove" class="label label-danger">
                <span class="glyphicon glyphicon glyphicon-remove"></span><span>remove</span>
              </a>
            </div>
        
            <div ng-show="$last">
              <br>
              <button class="btn btn-block btn-info" ng-click="newChoice()">
                Add <span class="glyphicon glyphicon-circle-arrow-down"></span>
              </button>
            </div>
            
          </div>
        </div>
      </div>
      
      <!-- SUBMIT -->
      <button class="btn btn-block btn-success" ng-click="saveChoices()" ng-show="mainGroup.$valid">
        Submit
      </button>
      
      <pre>
        {literal}{{choices}}{/literal}
      </pre>  
      
      </div>
  </div>
  
</div>