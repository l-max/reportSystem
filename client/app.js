'use strict';
// Ссылка на серверную часть приложения
var serviceBase = 'http://192.168.0.57/server/web/';
// Основной модуль приложения и его компоненты
var App = angular.module('App', [
    'ngRoute',
    'App.site',
    'App.report',
    'App.project'
]);
// модули
var App_site    = angular.module('App.site', ['ngRoute']);
var App_report  = angular.module('App.report', ['ngRoute', 'ui.bootstrap']);
var App_project = angular.module('App.project', ['ngRoute']);

App.config(['$routeProvider', function($routeProvider) {
    // Маршрут по-умолчанию
    $routeProvider.otherwise({redirectTo: '/report/index'});
}]);
