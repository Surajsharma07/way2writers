<?php

namespace App\Http\Requests\ADMIN;

use Illuminate\Foundation\Http\FormRequest;

class BlogCatFromRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
        'name' =>[
            'required',
            'string'
        ],
        'slug' =>[
            'required',
            'string'
        ],
        'description' =>[
            'required'
        ],
        'image' =>[
            'required',
            'mimes:jpeg,jpg,png'
        ],
        'meta_title' =>[
            'required',
            'string'
        ],
        'meta_description' =>[
            'required',
            'string'
        ],
        'meta_keywords' =>[
            'required',
            'string'
        ],
        'navbar_status' =>[
            'nullable',
            'boolean'
        ],
        'status' =>[
            'nullable',
            'boolean'
        ],
        'created_by' =>[
            'required',
            'string'
        ],
        'featured' =>[
            'nullable',
            'boolean'
        ],
    
        ];
        

            
            
            
            return $rules;
    }
}
