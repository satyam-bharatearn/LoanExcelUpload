<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;
  protected $fillable = ['name', 'created_by', 'permission'];

  public function permissions()
  {
    return $this->belongsToMany(Permission::class, 'permissions', 'role_id', 'permission_id');
  }

  public function hasPermission($name)
  {
    return $this->permissions->where('name', $name);
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'created_by');
  }
}

