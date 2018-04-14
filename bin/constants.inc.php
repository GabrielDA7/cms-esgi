<?php 
/******************************
********** CLASS NAMES ********
*******************************/
define("USER_CLASS_NAME", "User");
define("VIDEO_CLASS_NAME", "Video");
define("LESSON_CLASS_NAME", "Lesson");
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
define("VIEWS_TEMLATES_FOLDER_NAME", "views/templates");
define("CSS_FOLDER_NAME", "public/css");
define("IMAGE_FOLDER_NAME", "public/img");

/*******************************
********** CHARACTERS **********
********************************/
define("DS", "/");
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

/******************************
********** ROUTES *************
*******************************/
define("LOCATION", "Location:");

define("INSTALLATION_INDEX_LINK", "installation");
define("INSTALLATION_SETTING_LINK", "installation/setting");
define("INSTALLATION_DATABASE_LINK", "installation/database");
define("INSTALLATION_CREATE_DATABASE_LINK", "installation/createdatabase");
define("INSTALLATION_ADMIN_LINK", "installation/admin");

define("STATISTIC_INDEX_BACK_LINK", "statistic/index/back");

define("USER_LIST_FRONT_LINK", "user/list");
define("USER_LIST_BACK_LINK", "user/list/back");
define("USER_DELETE_BACK_LINK", "user/delete/back");
define("USER_EDIT_FRONT_LINK", "user/edit");
define("USER_EDIT_BACK_LINK", "user/edit/back");
define("USER_ADD_FRONT_LINK", "user/add");
define("USER_ADD_BACK_LINK", "user/add/back");
define("USER_LOGIN_FRONT_LINK", "user/login");
define("USER_LOGIN_BACK_LINK", "user/login/back");
define("USER_DISCONNECT_LINK", "user/disconnect");

define("INDEX_ERROR_LINK", "index/error");

define("FACEBOOK_LINK", "");
define("TWITTER_LINK", "");
define("INSTAGRAM_LINK", "");
define("LINKEDIN_LINK", "");

/******************************
********** VIEWS **************
*******************************/
define("INSTALLATION_INDEX_VIEW", "installation");
define("INSTALLATION_SETTING_VIEW", "installationSetting");
define("INSTALLATION_DATABASE_VIEW", "installationDatabase");
define("INSTALLATION_ADMIN_VIEW", "installationAdmin");

define("NOT_FOUND_VIEW", "404");
define("HOME_VIEW", "home");

define("CONTACT_VIEW", "contact");

define("USER_EDIT_FRONT_VIEW", "editUser");
define("USER_EDIT_BACK_VIEW", "editUserBack");
define("USER_LIST_FRONT_VIEW", "listUser");
define("USER_LIST_BACK_VIEW", "listUserBack");
define("USER_LOGIN_FRONT_VIEW", "loginUser");
define("USER_LOGIN_BACK_VIEW", "loginUserBack");
define("USER_ADD_FRONT_VIEW", "addUser");
define("USER_ADD_BACK_VIEW", "addUserBack");

define("VIDEO_FRONT_VIEW", "video");
define("VIDEO_LIST_FRONT_VIEW", "listVideo");

define("STATISTIC_BACK_VIEW", "statistic");

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