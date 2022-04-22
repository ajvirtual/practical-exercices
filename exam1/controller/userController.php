<?php
    session_regenerate_id(); // pour eviter les attaques par fixation pour qu'ensuite le fishing
    ini_set('session.use_only_cookies', 1);
    session_start();
if(isset($_POST["submit"])) {
    if(isset($_POST['login'])) {
       if(isset($_POST['username-login']) && !empty($_POST['username-login'])) {
        $username = htmlentities(trim($_POST['username-login']));
        if(preg_match("/^[a-zA-Z_-]+([a-zA-Z0-9_-])+$/", $username)) { 
            $passwd = htmlentities(trim($_POST['password-login']));
            require '../lib/db.php';
            $rq = $db->prepare("SELECT username, password FROM users WHERE username = :username");
            $rq->execute([
               'username' => $username,
            ]);
            if($rq->fetch()) {
                if(isset($passwd) && !empty($passwd)) {
                    $passwd = md5($passwd);
                    $rq = $db->prepare("SELECT username, password FROM users WHERE username = :username AND password = :passwd");
                    $rq->execute([
                       'username' => $username,
                       'passwd' => $passwd
                    ]);
                    if($rq->fetch()) {
                        setcookie('user', $username, time()+86400, '/');
                        $_SESSION['connexion'] = 'true';
                        header('location: .');
                    } else {
                       $mderror = "mot de passe incorrecte";
                       $nerror = 2;
                    }
               }
            } else {
                $uerror = "identifiant innexistant";
                $nerror = 1;
            }
            
        } else {
            $uerror = "veuillez entrer un identifiant valide";
            $nerror = 1;
        }
       } else {
            $uerror = 'veuillez entrer un identifiant';
            $nerror = 1;
        }

        if(isset($uerror) && !empty($uerror)) {
            $error = $uerror;
        }
        if(isset($mderror) && !empty($mderror)) {
            $error = $mderror;
        }
        if(!empty($error)) {
            header('location: ../public/index.php?p=front.user&error='.$error.'&n='.$nerror.'');
        } else {    
            header('location: ../public/index.php?p=front.liste');
        }
    } 

    // SIGN IN 

    if(isset($_POST['signin'])) {
        $username = htmlentities(trim($_POST['username-signup']));
        $email = htmlentities(trim($_POST['email-signup']));
        $passwd = htmlentities(trim($_POST['password-signup']));
        $conf_passwd = htmlentities(trim($_POST['cpassword-signup']));
        if(empty($username) && empty($email) && empty($passwd) && empty($conf_passwd)) {
            $error = 'veuillez remplir les champs';
        } else {
            $val_username = false;
            $val_email = false;
            $val_password = false;

            if(isset($passwd) and isset($conf_passwd)) {

                if ($passwd === $conf_passwd) {
                    $val_password = true;
                } else {
                    $error = 'mot de passe pas identique';
                    $nerror = 5;
                }
            }

            if(isset($email) and !empty($email)) {
                // if(preg_match("/^[a-zA-Z0-9_-.]+@[a-zA-Z0-9-._]+[a-z]{2,3}$/", $email)) {
                // } 
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $val_email = true;
                } else {
                    $error = 'veuillez entrez un email valide';
                    $nerror = 4;
                }
            } else {
                $error = 'veuillez entrez un email';
                $nerror = 4;
            }

            if(isset($username) and !empty($username)){
                if(preg_match("/^[a-zA-Z_-]+([a-zA-Z0-9_-])+$/", $username)) {
                    include('../lib/db.php');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $rq = $db->prepare('SELECT * FROM users WHERE username = :uname'); 
                    $rq->execute(['uname' => $username]);
                    if(!$rq->fetch()) {
                        $val_username = true;
                    } else {
                        $error = 'cette username existe deja';
                    }  
                } else {
                    $error = 'le champs username ne doit ni commencer par un chiffre ni comporter un caractère spéciaux autre que (_-.) ni des espaces';
                    $nerror = 3;
                }
            } else {
                $error = 'veuillez remplir le champs username';
                $nerror = 3;
            }
            
        }
        if(isset($val_username) && ($val_username == true) && isset($val_email) && ($val_email == true) && isset($val_password) && ($val_password == true)) {
            $passwd = md5($passwd);
            $role = 'user';
            try {
                include('../lib/db.php');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $rq = $db->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
                if($rq->execute([
                    'username' => $username,
                    'email' => $email,
                    'password' => $passwd,
                    'role' => $role
                ])) {
                    $conn = null;
                    header("location: ../public/index.php?p=front.user&success=true");
                } else {
                    header("location: ../public/index.php?p=front.user&error=".$error."");
                }
                
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        } else {
            header("location: ../public/index.php?p=front.user&error=".$error."&n=".$nerror."");
        }
    }
    // if(isset($_POST['login'])) {
    //     $valid_l = false;
    //     $username = htmlentities(trim($_POST["username"]));
    //     $passwd = htmlentities(trim($_POST["password"]));
    //     if(isset($username) and !empty($username)) {
    //         // if(preg_match("/^[a-zA-Z0-9_-.]+@[a-zA-Z0-9-._]+[a-z]{2,3}$/", $email)) {
    //         // } 
    //         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             $valid_l = true;
    //         } else {
    //             echo "<p style='color:red' >veuillez entrez un email valide</p>";
    //             $valid_l = false;
    //         }
    //     } else {
    //         echo "<p style='color:red' >veuillez entrez un email</p>";
    //     }
    //     if($valid_l) {
    //         $passwd = md5($passwd);
    //         try {
    //             $conn = new PDO("mysql:host=localhost;dbname=mybook", "root", "");
    //             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             $sql = "SELECT * FROM user where email = '$email' and password = '$passwd'";
    //             $req = $conn->prepare($sql);
    //             $req->execute();
    //             $res = $req->fetch();
    //             if($res > 0) {
    //                 $conn = null;
    //                 $cemail = "email";
    //                 setcookie($cemail, $email, time()+3600*24*3, "/");
    //                 $_SESSION["status"] = 1;
    //                 header("location: index.php");
    //             }
    //             $conn = null;
    //         } catch(PDOException $e) {
    //             echo "Connection failed: " . $e->getMessage();
    //         }
    //     }    
    // } 
    // if(isset($_POST['signin'])) {

    // }
}
include('../lib/connexion.php');
$act = isset($_GET['act']) ? htmlentities(trim($_GET['act'])) : '';
if(!empty($act)) {
    if($act == 'disconnect') {
        disconnect();
        header('location: ../public/index.php?p=front.user');
    }
}
?>