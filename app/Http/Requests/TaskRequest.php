<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id'     => 'exists:folders,id',
            'taskid' => 'exists:folders,id',
        ];
    }

    public function validationData() {
        $data = $this->all();
        if ( isset($this->id) ) {
            $data['id'] = $this->id;
        }
        if ( isset($this->task_id) ) {
            $data['id'] = $this->task_id;
        }

        return $data;
    }
}
