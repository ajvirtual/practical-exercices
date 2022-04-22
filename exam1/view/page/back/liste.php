<?php $title = 'posts list'; 
    // include('../model/adminModel.php');
?>

    <?php 
        if(isset($_GET['act']) && isset($_GET['res']) && $_GET['res'] == true) {
            if($_GET['act'] == 'modif') {
                echo '<p class="alert alert-success text-center">modification reussi</p>';
            } elseif($_GET['act'] == 'del') {
                echo '<p class="alert alert-success text-center">suppression reussi</p>';
            } elseif($_GET['act'] == 'add') {
                echo '<p class="alert alert-success text-center">insertion reussi</p>';
            }
        } elseif(isset($_GET['act']) && isset($_GET['res']) && $_GET['res'] == false) {
            if($_GET['act'] == 'modif') {
                echo '<p class="alert alert-danger text-center">modification echoue</p>';
            } elseif($_GET['act'] == 'del') {
                echo '<p class="alert alert-danger text-center">suppression echoue</p>';
            } elseif($_GET['act'] == 'add') {
                echo '<p class="alert alert-danger text-center">insertion echoue</p>';
            }
        }
    ?>
    
    <div class="container">
        <?php $categoryName = isset($_GET['categoriesName']) ? $_GET['categoriesName'] : '';?>
        <h1>Liste des articles du categorie <?php echo $categoryName ?></h1>
        <?php 
            $categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';

            if($postsList = postsListByCategory($categoryId)) {
                echo '
                <table>
                    <thead>
                        <tr>
                            <td>titre</td>
                            <td>contenu</td>
                            <td>date Ajout</td>
                            <td>date de modification</td>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($postsList as $key => $val) {
                        echo '
                            <tr>
                                <td>'.$val['title'].'</td>

                                <td>'.substr($val['content'], 0, 30).' ... </td>

                                <td>'.$val['dateInsert'].'</td>

                                <td>'.$val['dateModif'].'</td>

                                <td class="cell-custom">
                                    <a href="../controller/adminController.php?cid='.$categoryId.'&catname='.$categoryName.'&action=modif&postsId='.$val['id'].'" class="btn btn-primary">modifier</a>
                                </td>

                                <td class="cell-custom">
                                    <a href="../controller/adminController.php?cid='.$categoryId.'&catname='.$categoryName.'&action=delete&postsId='.$val['id'].'" class="btn btn-danger">supprimer</a>
                                </td>
                            </tr>   
                            ';
                    }
                echo '
                    </tbody>
                </table>
                ';
            } else {
                echo 'pas de liste dans le categorie '.$categoryName;
            }
        ?>          
    </div>