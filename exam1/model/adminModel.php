<?php 
    // include('../model/indexModel.php');
    function insertPostByCategory($categoryId, $post_ = []) {
        include('../lib/db.php');
        $rq = $db->prepare('INSERT INTO posts (title, content, dateInsert, categorie_id) VALUES (:title, :content, NOW(), :categoryId)');
         $rq->execute([
            'categoryId' => $categoryId,
            'title' => $post_['title'],
            'content' => $post_['content']
        ]);
    }

    function modifPostById($postId, $post = []) {
        include('../lib/db.php');
        $rq = $db->prepare('UPDATE posts SET title = :title, content = :content, dateModif = NOW() WHERE id = :postId');
        return $rq->execute([
            'postId' => $postId,
            'title' => $post['title'],
            'content' => $post['content']
        ]);
    }

    function deletePostById($postId){
        include('../lib/db.php');
        $rq = $db->prepare('DELETE FROM posts WHERE id = :pId');
        $rq->execute(['pId' => $postId]);
    }
?>