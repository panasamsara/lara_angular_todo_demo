<!doctype html>
<html lang="zh" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>todo演示</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.4.10/angular.js"></script>
    <script src="//cdn.bootcss.com/angular.js/1.4.10/angular-route.js"></script>
    <script src="{{ asset('js/app/app.js') }}"></script>
</head>
<body>
<div>
    <div ng-include src="'js/app/views/_header.html'"></div>
    <div ng-include src="'js/app/views/_flash.html'"></div>
    <div ng-view></div>

    <hr/>
</div>
</body>
</html>