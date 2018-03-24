<?php
class Video extends BaseSql{

	protected $id = null;
	protected $title;
	protected $duration;
	protected $live;
	protected $url;

	protected $Lesson_Id = null;

	public function __construct() {
		BaseSql::__construct();
	}

	public static function constructWithId($id) {
		$video = new self();
		$video->setId($id);
		return $video;
	}

	public static function constructWithParameters($title, $duration, $live, $url, $Lesson_Id) {
		$video = new self();
		$video->setTitle($title);
		$video->setDuration($duration);
		$video->setLive($live);
		$video->setUrl($url);
		$video->setLessonId($Lesson_Id);
		return $video;
	}

    public function getId(){
    	return $this->id;
    }

    public function setId($id){
    	$this->id = $id;
    }

    public function getTitle() {
    	return $this->title;
    }

    public function setTitle($title) {
    	$this->title = $title;
    }

    public function getDuration() {
    	return $this->duration;
    }

    public function setDuration($duration) {
    	$this->duration = $duration;
    }

    public function getLive() {
    	return $this->live;
    }

    public function setLive($live) {
    	$this->live = $live;
    }

    public function getUrl() {
    	return $this->url;
    }

    public function setUrl($url) {
    	$this->url = $url;
    }

    public function getLessonId() {
    	return $this->Lesson_Id;
    }

    public function setLessonId($Lesson_Id) {
    	$this->Lesson_Id = $Lesson_Id;
    }
}
?>