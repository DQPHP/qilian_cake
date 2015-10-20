<?php

class AdminController extends AppController {
	public $uses = array( 'Admin', 'Course', 'Teacher', 'Appointment' );
	public $layout = "bootstrap-admin";
	

	function beforeFilter(){
	    parent::beforeFilter();
	}

	public function index() {
		// $classes = $this->Course->find('all');
		// var_dump($classes);
		// $teachers = $this->Teacher->find('all');
		// var_dump($teachers);
		// $students = $this->Student->find('all');
		// var_dump($students);
		// $appointments = $this->Appointment->find('all');
		// var_dump($appointments);
	}

}
