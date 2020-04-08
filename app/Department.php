<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $fillable = [
          'dept_no',
          'dept_name',
          ];
    
    protected $table = "departments";
    
    public $timestamps = false;
	  protected $primaryKey = "dept_no"; 

	  public $incrementing = false;
	  protected $keyType = "string"; 
    
    public function deptempdept() {
      return $this->belongsToMany('App\Employee', 'dept_emp', 'dept_no', 'emp_no')->withPivot('from_date', 'to_date'); 
    }
  
    public function deptmanagerdept() {
      return $this->belongsToMany('App\Employee', 'dept_manager', 'dept_no', 'emp_no')->withPivot('from_date', 'to_date'); 
    }
}
