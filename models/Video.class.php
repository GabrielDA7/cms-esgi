<?php
class Video extends BaseSql {

	protected $id = null;
	protected $title;
	protected $duration;
	protected $live;
	protected $url;

	protected $chapter_Id = null;

	public function __construct() {
		BaseSql::__construct();
	}

    public function getColumns() {
        return get_object_vars($this);
    }

    public function getId()       { return $this->id;        }
    public function getTitle()    { return $this->title;     }
    public function getDuration() { return $this->duration;  }
    public function getLive()     { return $this->live;      }
    public function getUrl()      { return $this->url;       }
    public function getChapterId() { return $this->chapter_Id; }


    public function setId($id)              { $this->id = $id;               }
    public function setTitle($title)        { $this->title = $title;         }
    public function setDuration($duration)  { $this->duration = $duration;   }
    public function setLive($live)          { $this->live = $live;           }
    public function setUrl($url)            { $this->url = $url;             }
    public function setChapterId($chapter_Id) { $this->chapter_Id = $chapter_Id; }
}