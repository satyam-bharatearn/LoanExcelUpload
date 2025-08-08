<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColumnMapping extends Model
{
    use HasFactory;
    protected $fillable = ['lender_id', 'column_name', 'excel_position'];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }

}
