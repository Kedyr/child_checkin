<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('USER_ID','user_id');
define('USERNAME','username');
define('NAME','name');
define('ACCOUNT_ROLE','account_role');
define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');
define('ACCOUNT_ACTIVATED','account_activated');

define('TBL_CHILDREN','children');
define('TBL_CHECKINOUT','checkinout');
define('TBL_CHILD_HANDLER_RELATIONSHIP','childhandlerrelationship');
define('TBL_HANDLERS','handlers');
define('TBL_SERVICES','services');
define('TBL_UNREGISTERED_CHECKINOUT','unregisteredcheckinout');


define('COL_CHILD_NAME','childName');
define('COL_DOB','dob');
define('COL_SEX','sex');
define('COL_SCHOOL','school');
define('COL_RESIDENCE','residence');
define('COL_PHONENO','phoneNo');
define('COL_CELL_NO','cellNo');
define('COL_CELL_LEADER_NAME','cellLeaderName');
define('COL_CHURCH_MEMBERSHIP','churchMembership');
define('COL_CHILD_ID','childId');
define('COL_HANDLER_NAME','handlerName');
define('COL_HANDLER_ID','handlerId');
define('COL_RELATIONSHIP','relationship');
define('COL_CHECKIN_ID', 'checkInId');
define('COL_SERVICE_ID','serviceId');
define('COL_TIME_IN','timeIn');
define('COL_CHECK_IN_NUMBER','checkInNumber');
define('COL_STATUS','status');
define('COL_TIME_OUT','timeOut');
define('COL_COMMENTS','comments');
define('COL_SIBLING_COUNT','siblingCount');
define('COL_CHECK_IN_UnderId','checkinUnderId');
define('COL_SCHOOL_CLASS','schoolClass');
define('COL_CHURCH_CLASS','churchClass');
define('COL_OTHER_CHURCH','otherChurch');
define('COL_EMAIL','emailAddress');
define('COL_WORK_PLACE','workPlace');
define('COL_CELL_LEADER_CONTACT','cellLeaderContact');
/* End of file constants.php */
/* Location: ./application/config/constants.php */