<?php
class Statistic extends BaseSql {

	protected $id = null;
	protected $dateInserted;
	protected $views;
	protected $subscribers;
	protected $ip;

	protected $user_id;
	protected $user;
	protected $video_id;
	protected $video;
	protected $chapter_id;
	protected $chapter;
	protected $trainning_id;
	protected $trainning;

	public function __construct($table = null) {
		BaseSql::__construct($table);
	}

	public function getColumns() {
		return get_object_vars($this);
	}

  	public function getId() 		 { return $this->id; 		   }
	public function getViews() 		 { return $this->views; 	   }
	public function getSubscribers() { return $this->subscribers;  }
	public function getVideoId() 	 { return $this->video_id;     }
	public function getChapterId() 	 { return $this->chapter_id;   }
	public function getTrainningId() { return $this->trainning_id; }
    public function getDateInserted(){ return $this->dateInserted; }
    public function getIp() 		 { return $this->ip; 		   }
    public function getUserId()      { return $this->user_id;      }
    public function getUser()	     { return $this->user; 		   }
   	public function getVideo()       { return $this->video;        }
    public function getChapter() 	 { return $this->chapter;      }
    public function getTrainning()   { return $this->trainning;    }

	public function setId($id) 					  { $this->id = $id;				     }
	public function setViews($views) 			  { $this->views = $views; 				 }
	public function setSubscribers($subscribers)  { $this->subscribers = $subscribers;   }
	public function setVideoId($video_id) 		  { $this->video_id = $video_id; 		 }
	public function setChapterId($chapter_id) 	  { $this->chapter_id = $chapter_id; 	 }
	public function setTrainningId($trainning_id) { $this->trainning_id = $trainning_id; }
    public function setDateInserted($dateInserted){ $this->dateInserted = $dateInserted; }
    public function setIp($ip)					  { $this->ip = $ip;				     }
    public function setUserId($user_id)			  { $this->user_id = $user_id;  	     }
    public function setUser($user) 				  { $this->user = $user;			     }
    public function setVideo($video) 		      { $this->video = $video; 				 }
    public function setChapter($chapter)	      { $this->chapter = $chapter; 		     }
    public function setTrainning($trainning)      { $this->trainning = $trainning;       }
}