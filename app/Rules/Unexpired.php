<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class Unexpired implements ValidationRule
{
    public function __construct(protected $table, protected $column = 'expires_at')
    {
        //
    }

    /**
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (DB::table($this->table)->whereDate($this->column, '<', now())->exists()) {
            $fail(__("The $attribute provided is expired."));
        }
    }
}
