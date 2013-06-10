<?

if(!defined(ADMIN_ROLE)) define(ADMIN_ROLE,'1');
if(!defined(AGENT_ADMIN_ROLE)) define(AGENT_ADMIN_ROLE,'8');
if(!defined(AGENT_USER_ROLE)) define(AGENT_USER_ROLE,'9');
if(!defined(AGENT_GENERAL_ROLE)) define(AGENT_GENERAL_ROLE,'11');
if(!defined(AC_BACKEND_ADDRESS)) define(AC_BACKEND_ADDRESS,'http://backend.accidentreview.com/');

if(!defined(AR_ATTACHMENT_URL)) define(AR_ATTACHMENT_URL,'http://accidentreview.com/uploads/');
if(!defined(AR_ATTACHMENT_PATH)) define(AR_ATTACHMENT_PATH,dirname($_SERVER['DOCUMENT_ROOT']).'/content-frontend/uploads/');
//if(!defined(AR_ATTACHMENT_PATH)) define(AR_ATTACHMENT_PATH,'/var/www/vhosts/accidentreview.com/ar-git/content-frontend/uploads/');

if(!defined(AR_EMAIL_TEMPLATES_PATH)) define(AR_EMAIL_TEMPLATES_PATH,dirname($_SERVER['DOCUMENT_ROOT']).'/content-backend/application/config/templates/email/');
//if(!defined(AR_EMAIL_TEMPLATES_PATH)) define(AR_EMAIL_TEMPLATES_PATH,'/var/www/vhosts/accidentreview.com/ar-git/content-backend/application/config/templates/email/');
if(!defined(AR_EMAIL_FROM_NAME)) define(AR_EMAIL_FROM_NAME,'Accident Review');
if(!defined(AR_EMAIL_FROM_EMAIL)) define(AR_EMAIL_FROM_EMAIL,'no-reply@accidentreview.com');
if(!defined(AR_EMAIL_HOST)) define(AR_EMAIL_HOST,'mail.lifthousedesign.com');
if(!defined(AR_EMAIL_PORT)) define(AR_EMAIL_PORT,'25');
if(!defined(AR_EMAIL_USER)) define(AR_EMAIL_USER,'noreply@lifthousedesign.com');
if(!defined(AR_EMAIL_PASS)) define(AR_EMAIL_PASS,'9sbZdlAklydT');

include('custom/shortcodes.php');
include('custom/ajax.php');
include('custom/vin-functions.php');
include('custom/agent-login-form.php');
//include('custom/ac-user-functions.php');
include('custom/ar-user-functions.php');
include('custom/ac-email-functions.php');
include('custom/ac-job-functions.php');
include('custom/ac-assignment-functions.php');

?>
