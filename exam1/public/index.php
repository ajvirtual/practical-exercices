<?php
    session_start();
    // if(isset($_COOKIE['user']) && isset($_SESSION['connexion']) && $_SESSION['connexion'] == true) {
    //     echo '<h1>connexion true</h1>';
    // } else {
    //      echo '<h1>connexion false</h1>';
    // }
    // die;
    include(dirname(__DIR__).'/lib/config.php');
    include('../lib/connexion.php');
    if(!connected()) {
        ob_start();
        include(ROOT.'/view/page/front/user.php');
        $page = ob_get_clean();
        include(ROOT.'/view/template/home.php');
        exit;
    }
    
    include('../model/allModel.php');

    if(isset($_GET['p'])) { 
        $p = htmlentities(trim($_GET['p']));
        
        // INSERER UNE PAGE DANS  $pages  

            $templates = ['admin', 'front'];
            $pages = ['insert', 'liste', 'user', '404'];

        // INSERER UNE PAGE DAMS $pages

        $page = explode('.', $p);
        $control = isset($page[0]) ? $page[0] : null;
        $action = isset($page[1]) ? $page[1] : null;
        if(empty($p) || $control == null || $action == null || !in_array($action, $pages) || !in_array($control, $templates)) {
            ob_start();
            include(ROOT.'/view/page/error/404.php');
            $page = ob_get_clean();
            include(ROOT.'/view/template/home.php');
            exit;
        }
        if($control == 'front') {
            ob_start();
            include(ROOT.'/view/page/front/'.$action.'.php');
            $page = ob_get_clean();
            include(ROOT.'/view/template/home.php');
            exit;
        } elseif($control == 'admin') {
            ob_start();
            include(ROOT.'/view/page/back/'.$action.'.php');
            $page = ob_get_clean();
            include(ROOT.'/view/template/admin.php');
            exit;
        } else {
            ob_start();
            include(ROOT.'/view/page/error/404.php');
            $page = ob_get_clean();
            include(ROOT.'/view/template/home.php');
            exit;
        }
    } else {
        ob_start();
        include(ROOT.'/view/page/front/liste.php');
        $page = ob_get_clean();
        include(ROOT.'/view/template/home.php');
        exit;
    }
?>