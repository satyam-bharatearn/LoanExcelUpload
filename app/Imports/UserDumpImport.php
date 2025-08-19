<?php

namespace App\Imports;

use App\Models\Loan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserDumpImport implements ToCollection, WithHeadingRow
{
    public $errors = [];
    protected $rowCount = 1;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $this->rowCount++;
            $data = $row->toArray();
            $validator = Validator::make($data, [
                'app_id'   => 'required|string',
                'dates'    => 'required|date',
                'month'    => 'nullable|string',
                'name'     => 'nullable|string',
                'bank'     => 'nullable|string',
                'pl/bl'    => 'nullable|string',
                'location' => 'nullable|string',
                'company_name' => 'nullable|string',
                'sanction_amount' => 'nullable|numeric',
                'patner'   => 'nullable|string',
                'remarks'  => 'nullable|string',
                'payout'   => 'nullable|numeric',
                'sub'      => 'nullable|string',
                'bank_amount' => 'nullable|numeric',
                'ex_amount'   => 'nullable|numeric',
            ]);
            if ($validator->fails()) {
                $this->errors[] = [
                    'row'    => $this->rowCount,
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }
            Loan::create([
                'month'           => $data['month'] ?? null,
                'app_id'          => $data['app_id'],
                'name'            => $data['name'] ?? null,
                'bank'            => $data['bank'] ?? null,
                'pl_bl'           => $data['pl/bl'] ?? null,
                'location'        => $data['location'] ?? null,
                'company_name'    => $data['company_name'] ?? null,
                'sanction_amount' => $data['sanction_amount'] ?? null,
                'dates'           => $data['dates'],
                'patner'          => $data['patner'] ?? null,
                'remarks'         => $data['remarks'] ?? null,
                'payout'          => $data['payout'] ?? null,
                'sub'             => $data['sub'] ?? null,
                'bank_amount'     => $data['bank_amount'] ?? null,
                'ex_amount'       => $data['ex_amount'] ?? null,
            ]);
        }
    }
}
