<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // В ПЕРВУЮ ОЧЕРЕДЬ МЕНЯЕМ false НА true (если "return false", то пользователь не сможет отправлять данные, пока не авторизован. Меняем на true)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array // правила
    {
        return [
					'title' => 'string',
					'content' => 'string',
					'image' => 'string',
					"likes"=> '',
					'category_id' => '',
					'tags' =>'',
        ];
    }
}
