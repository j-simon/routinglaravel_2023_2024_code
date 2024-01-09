<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckLaravelInText implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
          //dd("ok? ".$value);
        if (strpos($value, 'Laravel') === false) {
            //dd("ok? ".$value);
            $fail($attribute.' enthält nicht den Text Laravel');
        }
            
    }
}
