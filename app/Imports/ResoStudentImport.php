<?php

namespace App\Imports;

use App\Models\ResoStudent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ResoStudentImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        // Define how to create a model from the Excel row data
        return new ResoStudent([
            'neet_application_no' => $row[0],
            'name' => $row[1],
            'father_name' => $row[2],
            'date_of_birth' => str_replace("'","",$row[3]),
            'gender' => $row[4],
            'email' => $row[5],
            'neet_registred_mobile_no' => $row[6],
            'alternate_number' => $row[7],
            'examination_center' => $row[8],
        ]);
    }
}
