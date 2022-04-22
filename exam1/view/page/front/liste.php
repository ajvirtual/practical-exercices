<div class="container">
    <?php 
        // include(ROOT.'/model/indexModel.php');
    ?>
    <br>
    <a href="encrypt_test.php?act=c" class="btn btn-primary">crypter</a>
    <a href="encrypt_test.php?act=d" class="btn btn-danger">decrypter</a>
    <a href="encrypt_test.php?act=cf" class="btn btn-primary">crypter fichier</a>
    <a href="encrypt_test.php?act=df" class="btn btn-danger">decrypter fichier</a>

    <h1>liste des 5 dernier articles</h1>
    
    <?php
        $listPost = listPosts(5);
        foreach($listPost as $key => $val) {
            echo '
                <div class="container">
                    <div>
                        <h4>'.$val['title'].'</h4>
                        <small class="float-right text-primary"> categorie : '.showCategoriesById($val['categorie_id'])['name'].'</small>
                    </div>
                    <div>
                        <div>'.$val['content'].'</div>
                        <div>
                            <small class="float-right text-primary">le '.$val['dateInsert'].'</small>
                        </div>
                    </div>
                </div> 
                <hr class="m-5">
            ';
        }
    ?>
</div>