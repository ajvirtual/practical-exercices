<?php
     $title = 'insertion';
    // include('../model/adminModel.php');
?>

<div class="container pt-5">
    <h3 class="text-center">inserer un article</h3>
    <form action="../controller/adminController.php?action=insert" method="post" ">
        <?php $postList = showCategories();?>
        <label>
            categories :
            <select name="postCategory" id="postCategory">
                <?php 
                    foreach($postList as $key => $val) {
                        echo '
                        <option value="'.$val['id'].'.'.$val['name'].'">'.$val['name'].'</option>
                        ';
                    }
                ?>
            </select>
        </label> <br>
        <label>
            titre :
            <input type="text" name="postTitle" id="postTitle" class="form-control">
        </label> <br>
        <label>
            contenu :
            <textarea name="postContent" id="postContent" cols="50" rows="6" class="form-control"></textarea>
        </label> <br>
        <input type="submit" value="inserer" class="btn btn-primary">
    </form>
</div>