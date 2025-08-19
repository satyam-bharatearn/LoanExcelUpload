<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoanTemplateExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
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

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('1')->getFill()->setFillType('solid')
            ->getStartColor()->setARGB('FFEFEFEF');

        return [];
    }
}
