var app = angular.module("app", [
    "ngRoute"
])

// 提示信息 服务
app.service('flashService', ["$rootScope", function ($rootScope) {
    var flashService = {}

    var add = function (type, msg) {
        $rootScope.flashes.push({
            'type': type, 
            'msg': msg, 
            'close': function () {
                flashService.close()
            }
        })
    }

    flashService.addSuccess = function (response) {
        $rootScope.flashes = []
        add('success', response.status.msg)
    }

    flashService.addError = function (response) {
        $rootScope.flashes = []
        // 捕获验证错误
        if (response.status = 422) {
            for (var key in response) {
                add(key, response[key][0])
            }
        } else {
            add('error', response.status.msg)
        }
    }

    flashService.close = function () {
        $rootScope.flashes = []
    }

    return flashService;
}])

// 简单封装model操作
app.service('TaskModel', ["$http", function ($http) {
    var model = {};
    // 得到记录列表
    model.all = function (pageNumber) {
        pageNumber = pageNumber ? pageNumber : 1;
        return $http.get('/api/tasks' + '?page=' + pageNumber)
            .then(function (response) {
                return response.data
            })
    }
    // 查找指定任务
    model.find = function (id) {
        return $http.get('/api/tasks/' + id)
            .then(function (response) {
                return response.data
            })
    }
    // 添加新任务保存
    model.store = function (task) {
        return $http.post('/api/tasks/', task)
            .then(function (response) {
                return response.data
            })
    }
    // 编辑新任务保存
    model.update = function (id, task) {
        return $http.put('/api/tasks/' + id, task)
            .then(function (response) {
                return response.data
            })
    }
    // 删除任务
    model.destroy = function (id) {
        return $http.delete('/api/tasks/' + id)
            .then(function (response) {
                return response.data
            })
    }

    return model
}])

app.controller("TasksController", ["$scope", "$route", "TaskModel", "flashService", "$location", function ($scope, $route, TaskModel, flashService, $location) {
    $scope.$location = $location  // 用于处理菜单active

    // 跳转前清空提示信息
    $scope.$on('$routeChangeStart', function (scope, next, current) {
        flashService.close()
    })

    // 重新解析列表和分页信息
    var init = function (response) {
        var tasks = response.content
        $scope.tasks = tasks.data
        $scope.page = {
            currentPage: tasks.current_page,
            lastPage: tasks.last_page
        }
    }

    // 初始化列表和分页信息
    TaskModel.all().then(function success(response) {
        init(response)
    }, function error(response) {
        console.log("api 调用错误.")
    })

    // 删除指定任务
    $scope.destroy = function (index) {
        var ok = confirm("您确定要删除吗?")
        if (ok) {
            TaskModel.destroy($scope.tasks[index].id).then(function success(response) {
                $scope.tasks.splice(index, 1);  // 从列表删除任务
                flashService.addSuccess(response)
            }, function error(response) {
                flashService.addError(response)
            })
        }
    }

    // 处理翻页
    $scope.setPage = function (pageNumber) {
        TaskModel.all(pageNumber).then(function success(response) {
            init(response)
        }, function error(response) {
            console.log("api 调用错误.")
        })
    }
}])

app.controller("TasksCreateController", ["$scope", "$route", "flashService", "TaskModel", function ($scope, $route, flashService, TaskModel) {
    $scope.task = {
        title: "",
        content: ""
    }

    // 添加保存
    $scope.store = function () {
        TaskModel.store($scope.task).then(function success(response) {
            $scope.task = {
                title: "",
                content: ""
            }
            flashService.addSuccess(response)
        }, function error(response) {
            flashService.addError(response)
        })
    }
}])

app.controller("TasksEditController", ["$scope", "$route", "flashService", "TaskModel", function ($scope, $route, flashService, TaskModel) {
    TaskModel.find($route.current.params.id).then(function success(response) {
        $scope.task = response.content
    }, function error(response) {
        console.log("api 调用错误")
    })

    // 编辑保存
    $scope.update = function () {
        TaskModel.update($route.current.params.id, $scope.task).then(function success(response) {
            flashService.addSuccess(response)
        }, function error(response) {
            flashService.addError(response)
        })
    }
}])

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/', {
        templateUrl: 'js/app/views/index.html',
        controller: 'TasksController'
    }).when('/about', {
        templateUrl: 'js/app/views/about.html'
    }).when('/create', {
        templateUrl: 'js/app/views/create.html',
        controller: 'TasksCreateController'
    }).when('/:id', {
        templateUrl: 'js/app/views/show.html',
        controller: 'TasksEditController'
    }).when('/:id/edit', {
        templateUrl: 'js/app/views/edit.html',
        controller: 'TasksEditController'
    }).otherwise({
        redirectTo: '/'
    })
}])

