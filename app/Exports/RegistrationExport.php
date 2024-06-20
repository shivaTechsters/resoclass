<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationExport implements FromCollection, WithHeadings
{
    public function headings(): array{
        return[
            'ID',
            'Name',
            'Reso Admit Card No',
            'NEET Application No',
            'Father Name',
            'Date of Birth',
            'Gender',
            'Email',
            'Neet Reg Phone',
            'Alternate Phone',
            'Examination Center'
        ];
    } 

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registration::join('examination_centers','registrations.examination_center_id' ,'=','examination_centers.id')
            ->select(
            'registrations.id',
            'registrations.name',
            'registrations.reso_admit_card_no',
            'registrations.neet_application_no',
            'registrations.father_name',
            'registrations.date_of_birth',
            'registrations.gender',
            'registrations.email',
            'registrations.neet_reg_phone',
            'registrations.alternate_phone', 
            'examination_centers.name as examination_center')
            ->get();
    }
}
