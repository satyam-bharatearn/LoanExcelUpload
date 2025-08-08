<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_by', 'level', 'is_employe','permission'];

    public function permissions(){
      return $this->belongsToMany(Permission::class, 'permission_role');
    }

     public function hasPermission($name)
    {
        return $this->permissions->where('name', $name);
    } 
}

 