<?php
namespace troy\CrontabManager;

class Crontab  {

	public $minute = '*';

	public $hour = '*';

	public $day = '*';

	public $month = '*';

	public $week = '*';

	public $command = '';

	public $errors = array();

	public function __construct(Array $crontab){
		$this->loadCrontabData($crontab);
	}

	public function loadCrontabData(Array $crontab){
		foreach ($crontab as $property => $value){
			if(property_exists($this,$property))
				$this->$property = $value;
		}
	}

	public function validate(){

		$this->validateCommand();

		return $this->errors;
	}

	public function validateCommand(){
		if(!$this->command)
			$this->errors['command'] = 'command can not be blank';

	}

	public function getCrontabString(){
		return !$this->errors? $this->minute.' '.$this->hour.' '.$this->day.' '.$this->month.' '.$this->week.' '.$this->command:'';
	}

	public function __toString(){
		return !$this->errors? $this->minute.' '.$this->hour.' '.$this->day.' '.$this->month.' '.$this->week.' '.$this->command:'';
	}
}