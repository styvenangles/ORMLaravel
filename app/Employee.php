<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $fillable = [
          'emp_no',
          'birth_date',
          'first_name',
          'last_name',
          'gender',
          'hire_date'
          ];
          
  public $timestamps = false;

  protected $primaryKey = "emp_no";
  
  public function title() {
    return $this->hasMany('App\Title', 'emp_no');
  }
  
  public function salary() {
    return $this->hasMany('App\Salary', 'emp_no');
  }
  
  public function deptemp() {
    return $this->belongsToMany('App\Department', 'dept_emp', 'emp_no', 'dept_no')->withPivot('from_date', 'to_date'); 
  }
  
  public function deptmanager() {
    return $this->belongsToMany('App\Department', 'dept_manager', 'emp_no', 'dept_no')->withPivot('from_date', 'to_date'); 
  }
}
