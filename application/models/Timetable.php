<?php

class Timetable extends CI_Model {
    protected $XMLDays = null; // xml files
    protected $XMLPeriods = null;
    protected $XMLCourses = null;

    protected $days = array();
    protected $periods = array();
    protected $courses = array();

    function __construct() {
        parent::__construct();
        $this->load->model('booking');

        $this->XMLDays = simplexml_load_file(DATAPATH . 'DayView.xml');
        $this->XMLPeriods = simplexml_load_file(DATAPATH . 'TimeSlotView.xml');
        $this->XMLCourses = simplexml_load_file(DATAPATH . 'CourseView.xml');

        foreach ($this->XMLDays->day as $day) {
            $type = (string)$day['type'];
            $bookings = array();

            foreach ($day->booking as $booking) {
                $r = new Booking();
                $r->setInstructor((string)$booking['instructor']);
                $r->setRoom((string)$booking['room']);
                $r->setType((string)$booking['type']);
                $r->setTime((string)$booking['time']);
                $r->setName((string)$booking['name']);

                array_push($bookings, $r);
            }

            $this->days[$type] = $bookings;
        }

        foreach ($this->XMLPeriods->period as $period) {
            $type = (string)$period['time'];
            $bookings = array();

            foreach ($period->booking as $booking) {
                $r = new Booking();
                $r->setInstructor((string)$booking['instructor']);
                $r->setRoom((string)$booking['room']);
                $r->setType((string)$booking['type']);
                $r->setDay((string)$booking['day']);
                $r->setName((string)$booking['name']);

                array_push($bookings, $r);
            }

            $this->periods[$type] = $bookings;
        }
        
        foreach ($this->XMLCourses->course as $course) {
            $type = (string)$course['code'];
            $bookings = array();

            foreach ($period->booking as $booking) {
                $r = new Booking();
                $r->setInstructor((string)$booking['instructor']);
                $r->setRoom((string)$booking['room']);
                $r->setType((string)$booking['type']);
                $r->setDay((string)$booking['day']);

                array_push($bookings, $r);
            }

            $this->courses[$type] = $bookings;
        }
    }

    function days() {
        return $this->days;
    }

    function periods() {
        return $this->periods;
    }
    
    function courses() {
        return $this->courses;
    }
}