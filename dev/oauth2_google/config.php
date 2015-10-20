<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
session_start();

$base_url= filter_var('http://qilian.jp', FILTER_SANITIZE_URL);

// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
define('CLIENT_ID','613926152463-hq894b11itgpv40gco41fhhds07grijb.apps.googleusercontent.com');
define('CLIENT_SECRET','tEd5hR4c31laz2AgwfPYnwFi');
define('REDIRECT_URI','http://qilian.jp/dev/oauth2_google/index.php');
define('APPROVAL_PROMPT','auto');
define('ACCESS_TYPE','offline');
?>