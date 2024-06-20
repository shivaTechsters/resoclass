<?php

namespace App\Imports;

use App\Models\Result;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ResultImport implements ToModel
{
    public function model(array $row)
    {
        return new Result([
            'admit_card_no' => $row[0],
            'phone' => $row[1],
            'bot_marks' => $row[2],
            'zoo_marks' => $row[3],
            'phy_marks' => $row[4],
            'che_marks' => $row[5],
            'total_marks' => $row[6],
            'percentage' => $row[7],
            'rank' => $row[8],
        ]);
    }
}
