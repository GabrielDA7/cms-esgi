<?php
class Statistic extends BaseSql {

	protected $id = null;
	protected $date;
	protected $views;
	protected $subscribers;

	protected $video_Id;
	protected $lesson_Id;
	protected $trainning_Id;


  	public function getId() 		 { return $this->id; 		   }
	public function getDate() 		 { return $this->date; 		   }
	public function getViews() 		 { return $this->views; 	   }
	public function getSubscribers() { return $this->subscribers;  }
	public function getVideoId() 	 { return $this->video_Id;     }
	public function getLessonId() 	 { return $this->lesson_Id;    }
	public function getTrainningId() { return $this->trainning_Id; }


	public function setId($id) 					  { $this->id = $id;				     }
	public function setDate($date) 				  { $this->date = $date; 				 }
	public function setViews($views) 			  { $this->views = $views; 				 }
	public function setSubscribers($subscribers)  { $this->subscribers = $subscribers;   }
	public function setVideoId($video_Id) 		  { $this->video_Id = $video_Id; 		 }
	public function setLessonId($lesson_Id) 	  { $this->lesson_Id = $lesson_Id; 		 }
	public function setTrainningId($trainning_Id) { $this->trainning_Id = $trainning_Id; }
}