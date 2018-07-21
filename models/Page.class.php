<?php
class Page extends BaseSql {

	protected $id = null;
	protected $title;
	protected $status;
	protected $url;

  public function getColumns() {
    return get_object_vars($this);
  }

	public function getId()      { return $this->id;       }
  public function getTitle()      { return $this->title;       }
  public function getStatus()      { return $this->status;       }
  public function getUrl()      { return $this->url;       }

  public function setId($id) 		      { $this->id = $id;  		     }
  public function setTitle($title) 		      { $this->title = $title;  		     }
  public function setStatus($status) 		      { $this->status = $status;  		     }
  public function setReport($url) 		      { $this->url = $url;  		     }
}
