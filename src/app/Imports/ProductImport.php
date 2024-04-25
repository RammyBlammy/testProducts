<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    public function collection(Collection $rows)
    {
    }
}
