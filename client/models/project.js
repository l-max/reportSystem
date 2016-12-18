'use strict';
App_project.factory("projectService", ['$http', '$location', '$route',
    function($http, $location, $route) {
        var obj = {};
        obj.getProjects = function() {
            return $http.get(serviceBase + 'projects');
        };
        obj.createProject = function (project) {
            return $http.post( serviceBase + 'projects', project)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $location.path('/projects/index');
            }
            function errorHandler(result){
                alert("Error data")
                $location.path('/projects/create')
            }
        };
        obj.getProject = function(projectId){
            return $http.get(serviceBase + 'projects/' + projectId);
        };

        obj.updateProject = function (project) {
            return $http.put(serviceBase + 'projects/' + project.id, project)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $location.path('/projects/index');
            }
            function errorHandler(result) {
                alert("Error data")
                $location.path('/projects/update/' + project.id)
            }
        };
        obj.deleteProject = function (projectId) {
            return $http.delete(serviceBase + 'projects/' + projectId)
                .then(successHandler)
                .catch(errorHandler);
            function successHandler(result) {
                $route.reload();
            }
            function errorHandler(result) {
                alert("Error data")
                $route.reload();
            }
        };
        return obj;
    }]);
