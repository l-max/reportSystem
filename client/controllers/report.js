'use strict';
/**
 * Контроллеры для работы с отчетами.
 */
App_report.config(['$routeProvider', function($routeProvider) {
    $routeProvider
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
        });
}])

    .controller('index', ['$scope', '$http', 'reportService', 'projectService',
    function($scope, $http, reportService, projectService) {
        if ($scope.projects === undefined) {
            $scope.projects = [];

            projectService.getProjects().then(function (projectData) {
                angular.forEach(projectData.data, function (project) {
                    $scope.projects[project.id] = project.name;
                });
            });
        }

        reportService.getReports(1, 'date', 'desc').then(function(data) {
            $scope.reports     = data.data;
            // pagination variables
            $scope.totalItems  = data.headers('X-Pagination-Total-Count');
            $scope.currentPage = data.headers('X-Pagination-Current-Page');
            $scope.maxSize     = 5;
            $scope.itemPerPage = data.headers('X-Pagination-Per-Page');
        });

        $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
        };

        $scope.pageChanged = function() {
            $scope.setDirection($scope.reverse);
            reportService.getReports($scope.currentPage, $scope.sortField, $scope.direction).then(function(response) {
                $scope.reports    = response.data;
                $scope.totalItems = response.headers('X-Pagination-Total-Count');
            });
        };

        $scope.deleteReport = function(reportId) {
            if(confirm("Вы действительно хотите удалить отчет c номером: " + reportId) == true && reportId > 0) {
                reportService.deleteReport(reportId);
                $route.reload();
            }
        };

        $scope.sortField = undefined;
        $scope.reverse = false;
        $scope.direction = 'asc';

        $scope.sort = function(field) {
            $scope.setDirection($scope.reverse);
            reportService.getReports(1, field, $scope.direction).then(function(response) {
                $scope.reports    = response.data;
                $scope.totalItems = response.headers('X-Pagination-Total-Count');

                if ($scope.sortField === field) {
                    $scope.reverse = !$scope.reverse;
                } else {
                    $scope.sortField = field;
                    $scope.reverse = false;
                }
            });
        };

        $scope.isSortUp = function(field) {
            return $scope.sortField === field && !$scope.reverse;
        };

        $scope.isSortDown = function(field) {
            return $scope.sortField === field && $scope.reverse;
        };

        $scope.setDirection = function(reverse) {
            if (reverse) {
                $scope.direction = 'asc';
            } else {
                $scope.direction = 'desc';
            }
        };
    }])
    .controller('create', ['$scope', '$http', 'reportService','$location', 'report', 'projectService',
        function($scope, $http, reportService, $location, report, projectService) {
            $scope.message = 'Все поля обязательны для заполнения.';

            projectService.getProjects().then(function(data) {
                $scope.projects = data.data;
            });

            $scope.createReport = function(report, selectedReport) {
                report.project_id = selectedReport.id;
                var results = reportService.createReport(report);
            }
        }])
    .controller('update', ['$scope', '$http', '$routeParams', 'reportService', '$location', 'report', 'projectService',
        function($scope, $http, $routeParams, reportService, $location, report, projectService) {
            $scope.message = 'Все поля обязательны для заполнения.';
            var original = report.data;
            $scope.report = angular.copy(original);
            $scope.report.date = new Date($scope.report.date);

            // get all projects
            projectService.getProjects().then(function(data) {
                $scope.projects = data.data;
                angular.forEach($scope.projects, function(project) {
                    // set current project
                    if (project.id === $scope.report.project_id) {
                        $scope.selectedItem = project;
                    }
                });
            });

            $scope.isClean = function() {
                return angular.equals(original, $scope.report);
            }

            $scope.updateReport = function(report, selectedReport) {
                report.project_id = selectedReport.id;
                var results = reportService.updateReport(report);
            }
        }]);
