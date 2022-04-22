<?php
    function listPosts($num = 5){
        include('../lib/db.php');
        $rq = $db->prepare('SELECT * FROM posts LIMIT 5');
        // $rq->execute(['num' => $num]);
        $rq->execute();
        return $rq->fetchAll();
    }

    function showCategories() {
        include('../lib/db.php');
       $rq = $db->query('SELECT * FROM categories');
       $rq->setFetchMode(PDO::FETCH_ASSOC);
        return $rq->fetchAll();        
    }

    function showCategoriesById($catId) {
        include('../lib/db.php');
       $rq = $db->prepare('SELECT * FROM categories WHERE id = :id');
       $rq->execute(['id' => $catId]);
       $rq->setFetchMode(PDO::FETCH_ASSOC);
        return $rq->fetch();        
    }

    function postsListByCategory($categoryId_) {
        $categoryId = htmlentities(trim($categoryId_));
        include('../lib/db.php');
        $rq = $db->prepare('SELECT * FROM posts WHERE categorie_id = :categoryId');
        $rq->execute(['categoryId' => $categoryId]);
        
        return $rq->fetchAll();
    }
?>