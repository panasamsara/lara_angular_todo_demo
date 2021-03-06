@extends('layouts.app')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('tasks.index') }}">任务列表</a></li>
            <li class="active">任务详情</li>
        </ol>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $task->title }}</div>
                    <div class="panel-body">
                        {{ $task->content }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-5">
                        <a href="{{ route('tasks.edit', [$task->id]) }}" class="btn btn-block btn-default"><i
                                    class="glyphicon glyphicon-pencil"></i> 编辑
                        </a>
                    </div>
                    <div class="col-sm-5">
                        <a href="{{ route('tasks.index') }}" class="btn btn-block btn-default">返回</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection