<?php

namespace App\Http\Controllers\Api;

use App\Api;
use App\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    /**
     * 显示任务列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest('id')->paginate(5);
        return Api::result($tasks->toArray());
    }

    /**
     * 处理添加任务保存
     *
     * @param  TaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());
        if ($task) {
            return Api::result(null, "添加任务保存成功.");
        }

        return Api::result(null, "添加任务保存失败.");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return Api::result($task->toArray());
    }

    /**
     * 处理编辑任务保存
     *
     * @param  TaskRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fill($request->all());
        if ($task->update()) {
            return Api::result(null, "编辑任务保存成功");
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return Api::result(null, '删除任务成功.');
    }
}
