<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description'];

    public function columnMappings()
    {
        return $this->hasMany(ColumnMapping::class);
    }

}
