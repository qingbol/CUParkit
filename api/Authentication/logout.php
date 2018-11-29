<?php
    session_start(); // Resume a session
    $_SESSION = array(); // Delete all global session data
    // Destroy the session, which effectively kills the 
    // shared token between the client and the server
    session_destroy(); 
    // The client-side javascript should redirect the user to the homepage after running this script
    