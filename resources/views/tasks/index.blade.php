@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{ route('tasks.create') }}" class="btn btn-default" title="添加"><i
                            class="glyphicon glyphicon-plus"></i> 添加</a>
            </div>
        </div>
        <table class="table table-condensed table-striped table-hover">
            <thead>
            <tr>
                <th>任务</th>
                <th>内容</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                    <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->content }}</a></td>
                    <td>
                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                            <a href="{{ route('tasks.edit', [$task->id]) }}" class="btn btn-default" title="编辑">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-default" title="删除"
                                    data-del="{{ route('tasks.destroy', [$task->id]) }}"
                                    data-token="{{ csrf_token() }}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $tasks->render() !!}
    </div>
    <script>
        $(function () {
            $("button[data-del]").on("click", function () {
                var ok = confirm("您确定要删除吗?")
                if (ok == true) {
                    var form = $("<form></form>")
                    form.attr("action", $(this).data("del"))
                    form.attr('method', 'post')
                    form.append($("<input type='hidden' name='_method' value='delete'>"))
                    var input = $("<input type='hidden' name='_token' />")
                    input.attr('value', $(this).data("token"))
                    form.append(input)

                    form.submit()
                }
            })
        })
    </script>
@endsection