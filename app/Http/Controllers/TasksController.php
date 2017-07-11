<?php

namespace App\Http\Controllers;

use App\Task;
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
        return view('tasks.index', compact('tasks'));
    }

    /**
     * 显示任务添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
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
            return back()->withErrors(['success' => '添加任务保存成功.']);
        }

        return back()->withInput();
    }

    /**
     * 显示任务详情
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * 显示任务编辑页面
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
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
            return back()->withInput()
                ->withErrors(['success' => '编辑任务保存成功.']);
        }

        return back()->withInput();
    }

    /**
     * 处理删除任务
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect(route('tasks.index'));
    }
}
