<?php
/******************************
********** CLASS NAMES ********
*******************************/
define("USER_CLASS_NAME", "User");
define("VIDEO_CLASS_NAME", "Video");
define("CHAPTER_CLASS_NAME", "Chapter");
define("PART_CLASS_NAME", "Part");
define("TRAINNING_CLASS_NAME", "Trainning");
define("COMMENT_CLASS_NAME", "Comment");
define("INSTALLATION_CLASS_NAME", "Installation");

/******************************
********** LABELS *************
*******************************/
define("ACTION_LABEL", "Action");
define("CONTROLLER_LABEL", "Controller");
define("INDEX_LABEL", "index");

/******************************
********** EXTENSION **********
*******************************/
define("CLASS_EXTENSION", ".class.php");
define("VIEW_EXTENSION", ".view.php");
define("TEMPLATE_EXTENSION", ".tpl.php");

/**********************************
********** FOLDERS NAMES **********
***********************************/
define("CONTROLLERS_FOLDER_NAME", "controllers");
define("DELEGATES_FOLDER_NAME", "delegates");
define("MODELS_FOLDER_NAME", "models");
define("CORE_FOLDER_NAME", "core");
define("VIEWS_FOLDER_NAME", "views");
define("MODALS_FOLDER_NAME", "views/modals");
define("VIEWS_TEMLATES_FOLDER_NAME", "views/templates");
define("CSS_FOLDER_NAME", "public/css");
define("IMAGE_FOLDER_NAME", "public/img");
define("AVATAR_FOLDER_NAME", "avatars");
define("VIDEO_FOLDER_NAME", "videos");
define("FORMATION_IMAGES_FOLDER_NAME", "trainnings");
define("CHAPTER_IMAGES_FOLDER_NAME", "chapters");

/*******************************
********** CHARACTERS **********
********************************/
define("UNDERSCORE", "_");
define("DOT", ".");
define("DOUBLE_DOT", "..");
define("QUESTION_MARK", "?");
define("COMMA", ",");
define("EQUAL", "=");
define("TWO_POINTS", ":");
define("PARENTHESIS_LEFT", "(");
define("PARENTHESIS_RIGHT", ")");
define("ALL", "*");
define("SPACE", " ");

/******************************
********** FILE PATH **********
*******************************/
define("CSS_PATH", "public/css/main.css");
define("LOGO_PATH", "public/img/logo.svg");
define("DEFAULT_AVATAR", DIRNAME . "public/img/avatars/default.jpg");

/******************************
********** ROUTES *************
*******************************/
define("LOCATION", "Location:");

define("INSTALLATION_INDEX_LINK", "installation");
define("INSTALLATION_SETTING_LINK", "installation/setting");
define("INSTALLATION_DATABASE_LINK", "installation/database");
define("INSTALLATION_CREATE_DATABASE_LINK", "installation/createdatabase");
define("INSTALLATION_ADMIN_LINK", "installation/admin");

define("STATISTIC_INDEX_BACK_LINK", "index/statistic/back");

define("USER_USER_FRONT_LINK", "user/user");
define("USER_USER_BACK_LINK", "user/user/back");
define("USER_EDIT_FRONT_LINK", "user/edit");
define("USER_EDIT_BACK_LINK", "user/edit/back");
define("USER_LIST_FRONT_LINK", "user/list");
define("USER_LIST_BACK_LINK", "user/list/back");
define("USER_DELETE_BACK_LINK", "user/delete/back");
define("USER_ADD_FRONT_LINK", "user/add");
define("USER_ADD_BACK_LINK", "user/add/back");
define("USER_LOGIN_FRONT_LINK", "user/login");
define("USER_LOGIN_BACK_LINK", "user/login/back");
define("USER_DISCONNECT_LINK", "user/disconnect");
define("USER_EMAIL_CONFIRM_LINK", "user/emailConfirm");
define("USER_PASSWORD_RESET_LINK", "user/passwordReset");
define("USER_PASSWORD_RESET_EMAIL_LINK", "user/passwordResetEmail");

define("TRAINNING_TRAINNING_BACK_LINK", "trainning/trainning/back");
define("TRAINNING_TRAINNING_FRONT_LINK", "trainning/trainning");
define("TRAINNING_ADD_BACK_LINK", "trainning/add/back");
define("TRAINNING_LIST_BACK_LINK", "trainning/list/back");
define("TRAINNING_LIST_FRONT_LINK", "trainning/list");

define("CHAPTER_CHAPTER_FRONT_LINK", "chapter/chapter");
define("CHAPTER_CHAPTER_BACK_LINK", "chapter/chapter/back");
define("CHAPTER_LIST_FRONT_LINK", "chapter/list");
define("CHAPTER_LIST_BACK_LINK", "chapter/list/back");
define("CHAPTER_ADD_BACK_LINK", "chapter/add/back");

define("VIDEO_VIDEO_FRONT_LINK", "video/video");
define("VIDEO_VIDEO_BACK_LINK", "video/video/back");
define("VIDEO_LIST_FRONT_LINK", "video/list");
define("VIDEO_LIST_BACK_LINK", "video/list/back");
define("VIDEO_ADD_BACK_LINK", "video/add/back");

define("INDEX_ERROR_LINK", "index/error");

define("FACEBOOK_LINK", "");
define("TWITTER_LINK", "");
define("INSTAGRAM_LINK", "");
define("LINKEDIN_LINK", "");

/******************************
********** TEMPLATE ***********
*******************************/
define("DEFAULT_TEMPLATES", 	 ["front"=> FRONT_TEMPLATE, 	   "back" => BACK_TEMPLATE]);
define("LOGIN_TEMPLATES", 		 ["front"=> FRONT_TEMPLATE, 	   "back" => LOGIN_BACK_TEMPLATE]);
define("INSTALLATION_TEMPLATES", ["front"=> INSTALLATION_TEMPLATE, "back" => INSTALLATION_TEMPLATE]);

/******************************
********** VIEWS **************
*******************************/
define("INSTALLATION_INDEX_VIEWS", 	  ["front"=> "installation", 		 "back" => "installation"]);
define("INSTALLATION_SETTING_VIEWS",  ["front"=> "installationSetting",  "back" => "installationSetting"]);
define("INSTALLATION_DATABASE_VIEWS", ["front"=> "installationDatabase", "back" => "installationDatabase"]);
define("INSTALLATION_ADMIN_VIEWS", 	  ["front"=> "installationAdmin",    "back" => "installationAdmin"]);

define("NOT_FOUND_VIEWS", ["front"=> "404",  "back" => "404"]);
define("HOME_VIEWS", 	  ["front"=> "home", "back" => ""]);
define("SEARCH_VIEWS", 	  ["front"=> "search", "back" => ""]);

define("CONTACT_VIEWS", ["front"=> "contact", "back" => "listVideoBack"]);

define("USER_USER_VIEWS",  ["front"=> "userUser",  "back" => "userUserBack"]);
define("USER_EDIT_VIEWS",  ["front"=> "editUser",  "back" => "editUserBack"]);
define("USER_LIST_VIEWS",  ["front"=> "listUser",  "back" => "listUserBack"]);
define("USER_LOGIN_VIEWS", ["front"=> "loginUser", "back" => "loginUserBack"]);
define("USER_ADD_VIEWS",   ["front"=> "addUser",   "back" => "addUserBack"]);
define("USER_CONFIRMATION_EMAIL_VIEWS",   ["front"=> "confirmationEmail",   "back" => ""]);
define("USER_PASSWORD_RESET_VIEWS",   ["front"=> "passwordReset",   "back" => ""]);
define("USER_PASSWORD_RESET_EMAIL_VIEWS",   ["front"=> "passwordResetEmail",   "back" => ""]);
define("USER_CONFIRMATION_PASSWORD_RESET_EMAIL_VIEWS",   ["front"=> "confirmationResetPasswordEmail",   "back" => ""]);

define("VIDEO_VIDEO_VIEWS", ["front"=> "videoVideo", "back" => "videoVideoBack"]);
define("VIDEO_LIST_VIEWS", ["front"=> "listVideo", "back" => "listVideoBack"]);
define("VIDEO_ADD_VIEWS", ["front"=> "", "back" => "addVideoBack"]);

define("STATISTIC_VIEWS", ["front"=> "", "back" => "statisticBack"]);

define("TRAINNING_TRAINNING_VIEWS",   ["front"=> "trainningTrainning", "back" => "trainningTrainningBack"]);
define("TRAINNING_LIST_VIEWS",   	  ["front"=> "listTrainning",      "back" => "listTrainningBack"]);
define("TRAINNING_ADD_VIEWS",   	  ["front"=> "",   			       "back" => "addTrainningBack"]);

define("CHAPTER_CHAPTER_VIEWS", ["front"=> "chapterChapter", "back" => "chapterChapterBack"]);
define("CHAPTER_ADD_VIEWS",     ["front"=> "", 			     "back" => "addChapterBack"]);
define("CHAPTER_LIST_VIEWS",    ["front"=> "listChapter",    "back" => "listChapterBack"]);
define("CHAPTER_EDIT_VIEWS",    ["front"=> "",    			 "back" => "editChapterBack"]);

/******************************
********** ROLE ***************
*******************************/
define("DEFAULT_ROLE", 0);
define("PREMIUM_ROLE", 1);
define("ADMIN_ROLE", 2);


/******************************
********** STATUS *************
*******************************/
define("DISCONNECTED_STATUS", 0);
define("CONNECTED_STATUS", 1);
