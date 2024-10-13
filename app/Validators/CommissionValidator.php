<?php
namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class CommissionValidator
{
    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'revenue' => 'required|numeric|min:0',
            'modelType' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}