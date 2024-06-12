<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueNormalized implements Rule
{
    protected $table;
    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        $normalizedValue = $this->normalizeString($value);

        return !DB::table($this->table)
            ->whereRaw("REPLACE(LOWER(REGEXP_REPLACE($this->column, '[^A-Za-z0-9]', '')), '', '') = ?", [$normalizedValue])
            ->exists();
    }

    public function message()
    {
        return 'El :attribute ya ha sido registrado';
    }

    private function normalizeString($string)
    {
        // Eliminar todos los caracteres no alfanuméricos y convertir a minúsculas
        return preg_replace('/[^A-Za-z0-9]/', '', strtolower($string));
    }
}
