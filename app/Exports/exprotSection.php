<?php

namespace App\Exports;

use App\Models\Section;
use Maatwebsite\Excel\Concerns\FromCollection;

class exprotSection implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Section::all();
    }


    public function headings(): array
    {
        return [
            'name_en',
            'name_ar',
            'desc_en',
            'desc_ar',
            'status',
            'photo',
            'created_at',
            'updated_at',
        ];
    }


}
