<?php

namespace App\Imports;

use App\Models\Section;
use Maatwebsite\Excel\Concerns\ToModel;

class importSection implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Section([
            'name_en'    =>  $row[1] ,
            'name_ar'    =>  $row[2],
            'desc_en'    =>  $row[3],
            'desc_ar'    =>  $row[4],
            'status'     =>  $row[5],
            'photo'      =>  $row[6],
            'created_at' =>  $row[7],
            'updated_at' =>  $row[8],
        ]);
    }
}
