<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">todo任务演示</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li {!! Request::path() == '/' || Request::segment(1) == 'tasks'  ? 'class="active"' : '' !!}>
                    <a href="{{ url('/') }}">任务列表 </a>
                </li>
                <li {!! Request::path() == 'about' ? 'class="active"' : '' !!}>
                    <a href="{{ url('/about') }}">关于</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('angular') }}">angular演示</a></li>
            </ul>
        </div>
    </div>
</nav>