<?php

namespace App\Rules;

use App\Models\Civil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class CheckCustomerIdCard implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $authIdcard = Civil::where('Id', Auth::user()->customer->civil_id)->first()->Id_number;
        if (Civil::where('id_number', $value)->count()!=0 && $authIdcard != $value) {
            return true;
        }
        // if (Civil::where('id_number', $value)->count()!=0 ) {
        //     return true;
        // }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Id Number is not accepted';
    }
}
