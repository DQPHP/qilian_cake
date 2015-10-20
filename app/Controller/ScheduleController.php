<?php

class ScheduleController extends AppController {

	function beforeFilter(){
	    parent::beforeFilter();
	}

	public function delete($id) {
		$this->autoRender = FALSE;
		if($id) {
			if($this->Schedule->delete($id)) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}