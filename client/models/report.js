'use strict';
App_report.factory("reportService", ['$http', '$location', '$route', 'projectService',
    function($http, $location, $route) {
        var obj = {};
        obj.getReports = function(page, field, direction) {
            return $http.get(serviceBase + 'reports?page=' + page + '&orderBy=' + field + ' ' + direction);
        };
        obj.createReport = function (report) {
            return $http.post( serviceBase + 'reports', report)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $location.path('/reports/index');
            }
            function errorHandler(result){
                alert("Error data");
                $location.path('/reports/create')
            }
        };
        obj.getReport = function(reportId){
            return $http.get(serviceBase + 'reports/' + reportId);
        };

        obj.updateReport = function (report) {
            return $http.put(serviceBase + 'reports/' + report.id, report)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $location.path('/reports/index');
            }
            function errorHandler(result) {
                alert("Error data");
                $location.path('/reports/update/' + report.id)
            }
        };
        obj.deleteReport = function (reportId) {
            return $http.delete(serviceBase + 'reports/' + reportId)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $route.reload();
            }
            function errorHandler(result) {
                alert("Error data");
                $route.reload();
            }
        };
        return obj;
    }]);
