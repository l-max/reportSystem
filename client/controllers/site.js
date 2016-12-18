'use strict';
App_site.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/site/about', {
            templateUrl: 'views/site/about.html',
            controller: 'about'
        })
        .otherwise({
            redirectTo: '/site/about'
        });
}])
    .controller('about', ['$scope', '$http', function($scope, $http) {
        $scope.message = 'Это страница с информацией о приложении.';
    }]);