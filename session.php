<?php

function updateSession(){
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    $now = time();
    if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
        // this session has worn out its welcome; kill it and start a brand new one
        session_unset();
        session_destroy();
        session_start();    
    }
    $_SESSION['discard_after'] = $now + 3600;
}
    functiongood_session() {if (array_key_exists("loggedin", $_SESSION) && $_SESSION["loggedin"] &&array_key_exists("sectionlog", $_SESSION) && $_SESSION["sectionlog"]==1) {returntrue;    } else {returnfalse;    }}
}

?>