<?php

namespace App\Imports;

use App\Models\Tendik;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TendikImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $coll)
        {
            Tendik::create([
                'name' => $coll[0],
                'nip' => $coll[1],
            ]);
        }
    }
}
