<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use App\Payloads\V1\NewBook;



class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
            'publisher'=>'required|string|max:255',
            'publication_date'=>'required|date',
            'description'=>'required|string|max:255',
        
            //
        ];
    }



    public function payloads():NewBook
    {
        return new NewBook(
            $this->input('title'),
            $this->input('publisher'),
            $this->input('publication_date'),
            $this->input('description'),
        );
    }
}
