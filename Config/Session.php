<?php

class Session
{
    public function __construct($pseudo)
    {
        session_start();
        $_SESSION['pseudo'] = $pseudo;
    }

    public function destroy()
    {
        session_start();
        unset($_SESSION['pseudo']);
        session_destroy();
    }
}