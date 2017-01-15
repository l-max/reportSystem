'use strict';
App_site.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/site/about', {
            templateUrl: 'views/site/about.html',
            controller: 'about'
        })
        .when('/login', {
            templateUrl: 'views/login.html',
            controller: 'LoginController'
        })
        .otherwise({
            redirectTo: '/site/about'
        });
}])
    .controller('about', ['$scope', '$http', function($scope, $http) {
        $scope.message = 'Это страница с информацией о приложении.';
    }])
    .controller('MainController', ['$scope', '$location', '$window',
        function ($scope, $location, $window) {
            $scope.loggedIn = function() {
                return Boolean($window.sessionStorage.access_token);
            };
            $scope.logout = function () {
                delete $window.sessionStorage.access_token;
                $location.path('/login').replace();
            };
        }
    ])
    .controller('LoginController', ['$scope', '$http', '$window', '$location',
        function($scope, $http, $window, $location) {
            $scope.login = function () {
                $scope.submitted = true;
                $scope.error = {};
                $http.post(serviceBase + 'user/login', $scope.userModel).success(
                    function (data) {
                        $window.sessionStorage.access_token = data.access_token;
                        $location.path('/report/index').replace();
                    }).error(
                    function (data) {
                        angular.forEach(data, function (error) {
                            $scope.error[error.field] = error.message;
                        });
                    }
                );
            };
        }
    ]);