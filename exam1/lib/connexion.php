<?php 

    function connected() {
        return (isset($_COOKIE['user']) && isset($_SESSION['connexion']) && $_SESSION['connexion'] === true);
    }

    function disconnect() {
        setcookie('user', '', time() - 99999);
        $_SESSION = [];
        session_destroy();
    }

?>