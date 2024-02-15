<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    protected $rules = [
            'category_id'=>['required','exists:categories,id'],
            'author_id'=>['required','exists:authors,id'],
            'name'=>['required','string'],
            'stock'=>['numeric','required'],
            'description'=>['string','required'],
            'file' => ['required','image']
    ];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // if($this->method()=='POST'){
        //     // array_push($rules['category_id'],'required');
        //     // array_push($rules['author_id'],'required');
        //     array_push($rules['name'],'unique:books,name');
        //     array_push($rules['stock'],'required');
        //     array_push($rules['description'],'required');

        // }else{
        //     // array_push($rules['category_id'],'unique:books,category_id,'. $this->book->id);
        //     // array_push($rules['author_id'],'unique:books,author_id,'. $this->book->id);
        //     array_push($rules['name'],'unique:books,name,'. $this->book->id);
        //     array_push($rules['stock'],'nullable');
        //     array_push($rules['description'],'nullable');
        // }
        return $this->rules;
    }

    public function messages()
    {
        return[
            'name.required'=>'El nombre es requerido',
            'name.string'=>'El nombre debe de ser valido',
        ];
    }
}
