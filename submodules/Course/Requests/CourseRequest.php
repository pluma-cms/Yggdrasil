<?php

namespace Course\Requests;

use Pluma\Requests\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isRoot()) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                if ($this->user()->can('store-course')) {
                    return true;
                }
                break;

            case 'PUT':
                if ($this->user()->can('update-course')) {
                    return true;
                }
                break;

            case 'DELETE':
                if ($this->user()->can('destroy-course')) {
                    return true;
                }
                break;

            default:
                return false;
                break;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $isUpdating = $this->method() == "PUT" ? ",id,$this->id" : "";

        return [
            'title' => 'required|max:255',
            'code' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:courses'.$isUpdating,
            'slug' => 'required|regex:/^[\pL\s\-\*\#\(0-9)]+$/u|unique:courses'.$isUpdating,
            'lessons' => 'required',
            'lessons.*.title' => 'required',
            // 'lessons.*.contents' => 'required',
            // 'lessons.*.contents.*.title' => 'required',
            // 'lessons.*.contents.*.library_id' => 'required',
        ];
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.regex' => 'Only letters, numbers, spaces, and hypens are allowed.',
            'lessons.*.title.required' => 'The Lesson Title field is required.',
            'lessons.*.contents.required' => 'Atleast one content field is required.',
            'lessons.*.contents.*.library_id.required' => 'The Interactive Content field is required.',
            'lessons.*.contents.*.title.required' => 'The Content Title field is required.',
        ];
    }
}
