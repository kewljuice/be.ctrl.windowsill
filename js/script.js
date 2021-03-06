/* 
 * be.ctrl.windowsill JavaScript
 */

// create our angular app
// ======================
var app = angular.module('angularjs-windowsill', []);

// configuration
// =============
app.config(['$interpolateProvider', function ($interpolateProvider) {
    'use strict';
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);

// custom directive
// ================
app.directive('checkunique', function () {
    'use strict';
    return {
        require: 'ngModel',
        link: function (scope, elm, attrs, ctrl) {
            // http://stackoverflow.com/questions/14477904/how-to-create-on-change-directive-for-angularjs
            // http://weblogs.asp.net/dwahlin/building-a-custom-angularjs-unique-value-directive
            ctrl.$parsers.unshift(function (viewValue) {
                // check for double or more
                var $count = 0;
                for (var i = 0, len = scope.choices.length; i < len; i++) {
                    if (scope.choices[i].name === viewValue) {
                        $count++;
                    }
                }
                // set custom validation
                if ($count > 0) {
                    ctrl.$setValidity('duplicate', false);
                }
                else {
                    ctrl.$setValidity('duplicate', true);
                }
                // return
                return viewValue;
            });
        }
    };
});

// our controller for the form
// ===========================
app.controller('mainCtrl', function ($scope, $http, $location) {
    'use strict';

    // variables
    $scope.$loader = false;
    var $url = $location.absUrl() + '/data';

    // load settings data
    $http({method: "post", url: $url, data: {'action': 'settings'},}).success(function (data) {
        $scope.choices = data;
    });

    // load views data
    $http({method: "post", url: $url, data: {'action': 'views'},}).success(function (data) {
        $scope.views = data;
        $scope.loader = true;
    });

    // add new
    $scope.newChoice = function () {
        var newItemNo = $scope.choices.length + 1;
        $scope.choices.push({'id': newItemNo, tab: false, token: false});
    };

    // remove person from group
    $scope.removeChoice = function (index) {
        // remove
        $scope.choices.splice(index, 1);
    };

});

