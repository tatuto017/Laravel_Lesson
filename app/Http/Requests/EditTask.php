<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rule = parent::rules();
        $status_rule = Rule::in(array_keys(Task::STATUS));

        return [
            'status' => 'required|' . $status_rule
        ];
    }

    public function attributes() {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態'
        ];
    }

    public function messages() {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        return $messages + [
            'status.in' => ':attributeには' . implode('、', $status_labels) . 'のいずれかを指定してください。'
        ];
    }
}
