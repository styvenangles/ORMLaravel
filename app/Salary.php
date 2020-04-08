<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
  protected $fillable = [
          'emp_no',
          'salary',
          'from_date',
          'to_date',
          ];

  public $timestamps = false;

  protected $table = "salaries";
  protected $primaryKey = "emp_no";
  
  public function employeesalary() {
    return $this->belongsTo('App\Employee', 'emp_no');
  }
}
