<?php
	class Video {

		protected $id = null;
		protected $title;
		protected $duration;
		protected $live;
		protected $url;

		protected $Lesson_Id = null;

		public function __construct() {
			UserSql::__construct();
		}

		
	}
?>