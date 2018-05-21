<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
  public $timestamps = false;
  protected $fillable = ['employee_id', 'name', 'seconds'];
}