<?php
    include("../fillin/scripts.php");
    sessions::delete_session($_SESSION["sessionid"]);
    unset($_SESSION["sessionid"]);
    session_destroy();
?>