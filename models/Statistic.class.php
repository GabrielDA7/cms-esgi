<?php
class Statistic extends BaseSql {

	protected $id = null;
	protected $dateInserted;
	protected $views;
	protected $subscribers;

	protected $video_Id;
	protected $chapter_Id;
	protected $trainning_Id;


  	public function getId() 		 { return $this->id; 		   }
	public function getViews() 		 { return $this->views; 	   }
	public function getSubscribers() { return $this->subscribers;  }
	public function getVideoId() 	 { return $this->video_Id;     }
	public function getChapterId() 	 { return $this->chapter_Id;   }
	public function getTrainningId() { return $this->trainning_Id; }
    public function getDateInserted(){ return $this->dateInserted; }

	public function setId($id) 					  { $this->id = $id;				     }
	public function setViews($views) 			  { $this->views = $views; 				 }
	public function setSubscribers($subscribers)  { $this->subscribers = $subscribers;   }
	public function setVideoId($video_Id) 		  { $this->video_Id = $video_Id; 		 }
	public function setChapterId($chapter_Id) 	  { $this->chapter_Id = $chapter_Id; 	 }
	public function setTrainningId($trainning_Id) { $this->trainning_Id = $trainning_Id; }
    public function setDateInserted($dateInserted){ $this->dateInserted = $dateInserted; }
}