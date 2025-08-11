<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IncomesImport implements WithMultipleSheets
{
    use Importable;

    protected $store_id;
    public function __construct($store_id)
    {
        $this->store_id = $store_id;
    }

    public function sheets(): array
    {
        return [
            1 => new IncomesSheetImport($this->store_id),
        ];
    }
}
