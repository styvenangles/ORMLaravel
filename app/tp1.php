<?php
use App\Employee; 
use App\Department; 
use App\Title; 
use App\Salary; 

public class Tp1 {

	/**
	 * Trouver les employées de sexe féminin classés par emp_no, limité aux 10 premiers résultats
	 */ 
	public function rqt1() {
 
		return App\Employee::where('gender', '=', 'F')->orderBy('emp_no', 'asc')->take(10)->get(); 

	}
	
	/**
	 * Trouver tous les employés dont le prénom est 'Troy'.
	 */
	public function rqt2() {
		return App\Employee::where('first_name', '=', 'Troy')->get();  
	}
	
	/**
	 * 
	 * Trouver tous les employés de sexe masculin nés après le 31 janvier 1965 
	 * 
	 * */
	public function rqt3() {
		return App\Employee::where('gender', '=', 'M')->where('birth_date', '>', '1965-01-31' )->get(); 
	}
	
	
	/**
	 * 
	 * Combien y a t'il de départements 
	 * 
	 * */
	public function rqt4() {
		return App\Department::all()->count('dept_no'); 
	}
	
	/**
	 * 
	 *  Combien de personnes dont le prénom est 'Richard' sont des femmes
	 * 
	 * */
	public function rqt5() {
		return App\Employee::where('gender', '=', 'F')->where('first_name', '=', 'Richard' )->get();  
	}
	
		
	/**
	 * 
	 * Combien y a t'il de titre différents d'employés 
	 * 
	 * */
	public function rqt6() {
		return App\Title::all()->groupBy('title')->count('title');  
	}
	
	
	/**
	 * 
	 * Le salaire moyen de l'employé numéro 287323 toute période confondu 
	 * 
	 * */
	public function rqt7() {
		return App\Salary::where('emp_no', '=', '287323')->avg('salary'); 
	}
	
	
	/**
	 * 
	 * Quel était le titre de Danny Rando le 12 janvier 1990 
	 * 
	 * */
	public function rqt8() {
		return App\Title::join('employees', 'titles.emp_no', '=', 'employees.emp_no')->where('employees.first_name', '=', 'Danny')->where('employees.last_name', '=', 'Rando')->where('titles.from_date', '<', '1990-01-12')->where('titles.to_date', '>', '1990-01-12')->get('title');  
	}
	
	/**
	 * 
	 * L'employé qui a eu le salaire maximum de tous les temps, et quel est le montant de ce salaire
	 * 
	 * */
	 public function rqt9() {
		 return App\Salary::join('employees', 'salaries.emp_no', '=', 'employees.emp_no')->orderBy('salary', 'desc')->first(); 
	 }
	 
	 /**
	  * 
	  * Combien d'employés travaillaient dans le département 'Sales' le 1er Janvier 2000
	  * 
	  */
	  public function rqt10() {
		  return App\Department::join('dept_emp', 'departments.dept_no', '=', 'dept_emp.dept_no')->where('dept_name', '=', 'Sales')->where('dept_emp.from_date', '<=', '2000-01-01')->where('dept_emp.to_date', '>=', '2000-01-01')->get()->count('emp_no'); 
	  } 
	  
	  /**
	   * Qui est le manager de Martine Hambrick actuellement et quel est son titre
	   */  
	  public function rqt11() {
		return App\Employee::join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')->join('dept_manager', 'dept_emp.dept_no', '=', 'dept_manager.dept_no')->join('employees as e', 'dept_manager.emp_no', '=', 'employees.e.emp_no')->join('titles', 'employees.e.emp_no', '=', 'titles.emp_no')->where('employees.first_name', '=', 'Martine')->where('employees.last_name', '=', 'Hambrick')->get('dept_manager.emp_no', 'employees.e.first_name', 'employees.e.last_name', 'titles.title');
	  }
}
