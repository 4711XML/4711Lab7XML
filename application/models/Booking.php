<?php
class Booking extends CI_Model
{
    protected $time = null;
    protected $day = null;
    protected $name = null;
    protected $instructor = null;
    protected $room = null;
    protected $type = null;

    public function __construct() {
        parent::__construct();
    }

    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function getDay() {
        return $this->day;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getInstructor() {
        return $this->instructor;
    }

    public function setInstructor($instructor) {
        $this->instructor = $instructor;
    }

    public function getRoom() {
        return $this->room;
    }

    public function setRoom($room) {
        $this->room = $room;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }
}