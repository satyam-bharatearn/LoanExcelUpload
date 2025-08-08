<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoanTemplateExport implements FromCollection, WithHeadingRow
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'MONTH',
            'APP ID',
            'NAME',
            'BANK',
            'PL/BL',
            'location',
            'COMPANY NAME',
            'SANCTION AMOUNT',
            'DATES',
            'PATNER',
            'Remarks',
            'Payout',
            'Sub',
            'Bank Amount',
            'Ex Amount',
        ];
    }
}
