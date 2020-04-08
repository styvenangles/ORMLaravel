<?php

namespace App\Http\Controllers;

use App\Salary;
use App\Employee;
use App\Http\Requests\SalaryRequest as Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Salary::chunk(10, function($salary) {
		      return $salary;
	      });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emp_check = $request->get('emp_no');
        $emp_checked = Employee::find($emp_check)->emp_no;
    
        if ($emp_checked != $emp_check) {
          return false;
        }
        else {
          $multiple_salary = Salary::where('emp_no', '=', $emp_check)->where('to_date', '=', '9999-01-01')->first();
          if ($multiple_salary == null) {
            $salary = new Salary([
              'emp_no'=> $request->get('emp_no'),
              'salary'=> $request->get('salary'),
              'from_date'=> NOW(),
              'to_date'=> '9999-01-01'
            ]);
            $salary->save();
            
            return $salary;
          }
          else {
            $multiple_salary->to_date = NOW();
            $multiple_salary->save();
            
            $salary = new Salary([
              'emp_no'=> $request->get('emp_no'),
              'salary'=> $request->get('salary'),
              'from_date'=> NOW(),
              'to_date'=> '9999-01-01'
            ]);
            $salary->save();
            
            return $salary;
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        $salaries = Salary::where('emp_no', '=', $salary->emp_no)->get();
        return $salaries;
    }
}
