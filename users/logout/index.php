<?php
    session_start();
    $_SESSION['logged'] = -1;
    session_unset();
    session_destroy();
    header("Location: ../index.php");
?>