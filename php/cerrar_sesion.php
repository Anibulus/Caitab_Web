<?php

    session_start();
    //ssession_unset();
    session_destroy();
    //session_write_close();
    //setcookie(session_name(),'',0,'/');
    //session_regenerate_id(true);
    header("old-caitab-web/index.html");

?>
