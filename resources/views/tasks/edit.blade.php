@extends('layouts.app')
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('tasks.index') }}">任务列表</a></li>
            <li class="active">编辑</li>
        </ol>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form action="{{ route('tasks.update', [$task->id]) }}" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">任务标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ old('title', $task->title) }}"
                                   placeholder="请填写任务标题"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-sm-2 control-label">任务内容</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="content" name="content"
                                   value="{{ old('content', $task->content) }}"
                                   placeholder="请填写任务内容"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <button type="submit" class="btn btn-block btn-default"><i
                                        class="glyphicon glyphicon-pencil"></i> 保存
                            </button>
                        </div>
                        <div class="col-sm-5">
                            <a href="{{ route('tasks.index') }}" class="btn btn-block btn-default">返回</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection