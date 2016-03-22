<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
    protected $data = array();      // parameters for view components
	function __construct() {
		parent::__construct();
		$this->load->model('timetable');
        $this->load->library('parser');
        $this->data = array();
        $this->data['pagetitle'] = 'Schedule';
	}
    /**
     * Render this page
     */
    function render()
    {
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }

	public function index() {
		$days    = $this->timetable->days();
		$periods = $this->timetable->periods();
		$courses = $this->timetable->courses();
		
		$dayKeys    = array_keys($days);
		$periodKeys = array_keys($periods);
		$courseKeys = array_keys($courses);
		$periodData = array();
		$daysData = array();
		$courseData = array();
		foreach($periodKeys as $key) {
			$tmp = null;
			$bookings = array();
			for($i = 0; $i < sizeof($periods[$key]); $i++) {
				$booking = array(
					"instructor" => $periods[$key][$i]->getInstructor(),
					"room" 		 => $periods[$key][$i]->getRoom(),
					"type"       => $periods[$key][$i]->getType(),
					"day"        => $periods[$key][$i]->getDay(),
					"name"       => $periods[$key][$i]->getName()
				);
				array_push($bookings, $booking);
			}
			$tmp = array(
				"time"    => $key,
				"booking" => $bookings
			);
			$periodData[$key] = $tmp;
		}
		foreach($dayKeys as $key) {
			$tmp = null;
			$bookings = array();
			for($i = 0; $i < sizeof($days[$key]); $i++) {
				$booking = array(
					"instructor" => $days[$key][$i]->getInstructor(),
					"room" 		 => $days[$key][$i]->getRoom(),
					"type"       => $days[$key][$i]->getType(),
					"time"       => $days[$key][$i]->getTime(),
					"name"       => $days[$key][$i]->getName()
				);
				array_push($bookings, $booking);
			}
			$tmp = array(
				"day"	  => $key,
				"booking" => $bookings
			);
			$daysData[$key] = $tmp;
		}
		foreach($courseKeys as $key) {
			$tmp = null;
			$bookings = array();
			for($i = 0; $i < sizeof($courses[$key]); $i++) {
				$booking = array(
					"instructor" => $courses[$key][$i]->getInstructor(),
					"room" 		 => $courses[$key][$i]->getRoom(),
					"type"       => $courses[$key][$i]->getType(),
					"time"       => $courses[$key][$i]->getTime(),
					"day"        => $courses[$key][$i]->getDay()
				);
				
				array_push($bookings, $booking);
			}
			$tmp = array(
				"code"	  => $key,
				"booking" => $bookings
			);
			$courseData[$key] = $tmp;
		}
		$this->data['pagebody'] = 'welcome_message';
		$this->data['periods']  = $periodData;
		$this->data['days']     = $daysData;
		$this->data['courses']  = $courseData;
		$this->render();
	}
}