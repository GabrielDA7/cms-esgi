<?php
class Video extends BaseSql {

	protected $id = null;
	protected $title;
	protected $duration;
	protected $live;
	protected $url;

	protected $lesson_Id = null;

	public function __construct() {
		BaseSql::__construct();
	}

    public function getColumns() {
        return get_object_vars($this);
    }

    public function getId() {
    	return $this->id;
    }

    public function setId($id) {
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