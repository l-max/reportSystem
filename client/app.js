'use strict';
// Ссылка на серверную часть приложения
var serviceBase = 'http://192.168.0.57/server/web/';
// Основной модуль приложения и его компоненты
var App = angular.module('App', [
    'ngRoute',
    //'mgcrea.ngStrap',   //bs-navbar, data-match-route directives
    'App.site',
    'App.report',
    'App.project'
]);
// модули
var App_site    = angular.module('App.site', ['ngRoute']);
var App_report  = angular.module('App.report', ['ngRoute', 'ui.bootstrap']);
var App_project = angular.module('App.project', ['ngRoute']);

App.config(['$routeProvider', '$httpProvider', function($routeProvider, $httpProvider) {
    $routeProvider
        .when('/site/about', {
            templateUrl: 'views/site/about.html',
            controller: 'about'
        })
        .when('/login', {
            templateUrl: 'views/login.html',
            controller: 'LoginController'
        })
        .when('/report/index', {
            templateUrl: 'views/report/index.html',
            controller: 'index'
        })
        .when('/report/create', {
            templateUrl: 'views/report/create.html',
            controller: 'create',
            resolve: {
                report: function(reportService, $route) {
                    return reportService.getReports();
                }
            }
        })
        .when('/report/update/:reportId', {
            templateUrl: 'views/report/update.html',
            controller: 'update',
            resolve: {
                report: function(reportService, $route) {
                    var reportId = $route.current.params.reportId;
                    return reportService.getReport(reportId);
                }
            }
        })
        .when('/report/delete/:reportId', {
            templateUrl: 'views/report/index.html',
            controller: 'delete'
        })
        .otherwise({
            redirectTo: '/site/about'
        });
    $httpProvider.interceptors.push('authInterceptor');
}]);

// проверка на авторизованного пользователя.
App.factory('authInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $location.path('/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});