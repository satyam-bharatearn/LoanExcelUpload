<?php

namespace App\Imports;

use App\Models\Loan;
use App\Models\Lender;
use App\Models\ColumnMapping;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LoanImport implements ToCollection, SkipsOnFailure, WithBatchInserts, WithChunkReading, WithCustomCsvSettings, WithStartRow, WithCalculatedFormulas
{
    use Importable, SkipsFailures, SkipsErrors;

    protected $headers = [];
    protected $lenderId;
    protected $columnMappings;
    protected $validationRules = [
        'month' => 'nullable|string',
        'app_id' => 'required|string',
        'name' => 'nullable|string',
        'bank' => 'nullable|string',
        'pl_bl' => 'nullable|string',
        'location' => 'nullable|string',
        'company_name' => 'nullable|string',
        'sanction_amount' => 'nullable|string',
        'date' => 'required|string',
        'partner' => 'nullable|string',
        'remarks' => 'nullable|string',
        'payout_percent' => 'nullable|string',
        'sub' => 'nullable|string',
        'bank_amount' => 'nullable|string',
        'ex_amount' => 'nullable|string',
    ];

    public function __construct($lenderId)
    {
        $this->lenderId = $lenderId;
        $this->loadColumnMappings();
    }

    protected function loadColumnMappings()
    {
        $this->columnMappings = ColumnMapping::where('lender_id', $this->lenderId)
            ->get()
            ->mapWithKeys(function ($mapping) {
                return [$mapping->excel_position => $mapping->column_name];
            });
    }

    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $index => $row) {
    //         $rowNumber = $index + 2;
    //         $row = collect($row)->filter(function ($value) {
    //             return !is_null($value) && $value !== '';
    //         })->values();
    //         if ($row->isEmpty()) {
    //             continue;
    //         }
    //         $mappedData = $this->mapRowData($row);
    //         $mappedData = array_filter($mappedData, function ($value) {
    //             return !is_null($value) && $value !== '';
    //         });
    //         $validator = Validator::make($mappedData, $this->validationRules);
    //         if ($validator->fails()) {
    //             foreach ($validator->errors()->getMessages() as $attribute => $messages) {
    //                 $failure = new \Maatwebsite\Excel\Validators\Failure(
    //                     $rowNumber,
    //                     $attribute,
    //                     $messages,
    //                     $row->toArray()
    //                 );
    //                 $this->onFailure($failure);
    //             }
    //             continue;
    //         }
    //         dd($mappedData); // Debugging line, remove in production
    //         if (!empty($mappedData)) {
    //             Loan::create($mappedData);
    //         }
    //     }
    // }


    // protected function mapRowData($row)
    // {
    //     $row = collect($row)->filter(function ($value) {
    //         return !is_null($value) && $value !== '';
    //     })->values();
    //     $mappedData = [];
    //     foreach ($this->columnMappings as $excelPosition => $columnName) {
    //         $index = $this->excelColumnLetterToIndex($excelPosition);
    //         $dbField = $this->convertToDatabaseField($columnName);
    //         if (isset($row[$index]) && $row[$index] !== null) {
    //             $cellValue = $row[$index];
    //             if (is_numeric($cellValue) && $cellValue > 40000 && $cellValue < 60000) {
    //                 $phpDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cellValue);
    //                 $mappedData[$dbField] = $phpDate->format('Y-m-d');
    //             } elseif (is_numeric($cellValue)) {
    //                 $mappedData[$dbField] = (string) (int) $cellValue;
    //             } else {
    //                 $mappedData[$dbField] = (string) $cellValue;
    //             }
    //         }
    //     }
    //     return $mappedData;
    // }



    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;
            // Remove ->values() to preserve original indexes
            $row = collect($row)->map(function ($value) {
                return ($value !== '' && !is_null($value)) ? $value : null;
            });
            if ($row->filter(function ($value) {
                return !is_null($value); })->isEmpty()) {
                continue;
            }
            $mappedData = $this->mapRowData($row);
            $mappedData = array_filter($mappedData, function ($value) {
                return !is_null($value) && $value !== '';
            });
            $validator = Validator::make($mappedData, $this->validationRules);
            if ($validator->fails()) {
                foreach ($validator->errors()->getMessages() as $attribute => $messages) {
                    $failure = new \Maatwebsite\Excel\Validators\Failure(
                        $rowNumber,
                        $attribute,
                        $messages,
                        $row->toArray()
                    );
                    $this->onFailure($failure);
                }
                continue;
            }
            // dd($mappedData);
            if (!empty($mappedData)) {
                Loan::create($mappedData);
            }
        }
    }

    protected function mapRowData($row)
    {
        // Do NOT use ->values(), keep original indexes
        $mappedData = [];
        foreach ($this->columnMappings as $excelPosition => $columnName) {
            $index = $this->excelColumnLetterToIndex($excelPosition);
            $dbField = $this->convertToDatabaseField($columnName);
            // Use $row->get($index) to get value by original index
            $cellValue = $row->get($index, null);
            if ($cellValue !== null && $cellValue !== '') {
                if (is_numeric($cellValue) && $cellValue > 40000 && $cellValue < 60000) {
                    $phpDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cellValue);
                    $mappedData[$dbField] = $phpDate->format('Y-m-d');
                } elseif (is_numeric($cellValue)) {
                    $mappedData[$dbField] = (string) (int) $cellValue;
                } else {
                    $mappedData[$dbField] = (string) $cellValue;
                }
            } else {
                $mappedData[$dbField] = null;
            }
        }
        return $mappedData;
    }

    protected function excelColumnLetterToIndex($letter)
    {
        $letter = strtoupper(trim($letter));
        $index = 0;
        $length = strlen($letter);
        for ($i = 0; $i < $length; $i++) {
            $index *= 26;
            $index += ord($letter[$i]) - ord('A') + 1;
        }
        return $index - 1;
    }


    protected function convertToDatabaseField($columnName)
    {
        $mappings = [
            'MONTH' => 'month',
            'APP ID' => 'app_id',
            'NAME' => 'name',
            'BANK' => 'bank',
            'PL/BL' => 'pl_bl',
            'location' => 'location',
            'COMPANY NAME' => 'company_name',
            'SANCTION AMOUNT' => 'sanction_amount',
            'DATES' => 'date',
            'PATNER' => 'partner',
            'Remarks' => 'remarks',
            'Payout' => 'payout_percent',
            'Sub' => 'sub',
            'Bank Amount' => 'bank_amount',
            'Ex Amount' => 'ex_amount',
        ];
        return $mappings[$columnName] ?? strtolower(str_replace(' ', '_', $columnName));
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
        ];
    }

    public function startRow(): int
    {
        return 2;
    }
}