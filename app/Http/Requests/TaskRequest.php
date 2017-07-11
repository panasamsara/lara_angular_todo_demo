<?php
namespace App\Http\Requests;
class TaskRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * 添加任务验证规则
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255|unique:tasks',
            'content' => 'required|max:255',
        ];
        // 处理编辑保存时，标题会提示重复
        if (strlen($this->route()->parameter('tasks')) > 0) {
            $rules['title'] = 'required|max:255|unique:tasks,title,' . $this->route()->parameter('tasks');
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'title' => '任务标题',
            'content' => '任务内容'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute 必须填写.',
            'max' => ':attribute 必须在 :max 个字之内.',
            'title.unique' => '任务标题有重复.'
        ];
    }
}