<?php
    include('../model/adminModel.php');
    if(isset($_GET['action'])) {

        // MODIFICATION
        if($_GET['action'] === 'modif') {
            // echo '<h1>bonjour moi</h1>'; die;
            $modifId = isset($_GET['postsId']) ? htmlentities(trim($_GET['postsId'])) : null;
            $post = [
                'title' => 'juste un autre titre',
                'content' => 'voila un tout autre contenu non lorem ipsum , salut tout le monde'
            ];
            $categoryId = isset($_GET['cid']) ? htmlentities(trim($_GET['cid'])) : null;
            $categoryName = isset($_GET['catname']) ? htmlentities(trim($_GET['catname'])) : null;
            if(modifPostById($modifId, $post)) {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$categoryId.'&categoriesName='.$categoryName.'&act=modif&res=true');
            } else {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$categoryId.'&categoriesName='.$categoryName.'&act=modif&res=false');
            }

        } 
        // MODIFICATION

        // SUPPRESSION
        elseif($_GET['action'] === 'delete'){
            $delId = isset($_GET['postsId']) ? htmlentities(trim($_GET['postsId'])) : null;
            $categoryId = isset($_GET['cid']) ? htmlentities(trim($_GET['cid'])) : null;
            $categoryName = isset($_GET['catname']) ? htmlentities(trim($_GET['catname'])) : null;
            if(deletePostById($delId)) {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$categoryId.'&categoriesName='.$categoryName.'&act=del&res=true');
            } else {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$categoryId.'&categoriesName='.$categoryName.'&act=del&res=false');
            }
            
        }
        // SUPPRESSION  

        // INSERTION
        elseif($_GET['action'] == 'insert') {
            $postCategory = isset($_POST['postCategory']) ? htmlentities(trim($_POST['postCategory'])) : '';
            $postCategory = explode('.', $postCategory);

            $postTitle = isset($_POST['postTitle']) ? htmlentities(trim($_POST['postTitle'])) : '';

            $postContent = isset($_POST['postContent']) ? htmlentities(trim($_POST['postContent'])) : '';
            $post = [
                'title' => $postTitle,
                'content' => $postContent
            ];
            if(insertPostByCategory($postCategory[0], $post)) {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$postCategory[0].'&categoriesName='.$postCategory[1].'&act=add&res=true');
            } else {
                header('location: ../public/index.php?p=admin.liste&categoryId='.$postCategory[0].'&categoriesName='.$postCategory[1].'&act=add&res=false');
            }
            
        }
        // INSERTION 

    } 
?>