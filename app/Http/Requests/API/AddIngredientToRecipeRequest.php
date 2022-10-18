<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class AddIngredientToRecipeRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recipe_id' => 'required|numeric',
            'ingredient_id' => 'required|numeric',
            'qty_in_recipe' => 'required|numeric|min:0.001'
        ];
    }
}
