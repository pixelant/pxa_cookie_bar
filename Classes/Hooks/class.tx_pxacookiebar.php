<?php

class tx_pxacookiebar {
	function contentPostProc_all(&$params, &$reference){
		if(!isset($_COOKIE['pxa_cookie_warning']) &&  (intval($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_pxacookiebar.']['settings.']['disableCookies']) == 1)) {	
			if(session_id()) {	
				setcookie(session_name(), session_id(), time()-60*60*24, '/');        
		        session_unset();
		        session_destroy();
	        }
    	}
	}	
}

?>