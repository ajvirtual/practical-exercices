<header class="header">
    <nav class="navbar navbar-expand-sm navbar-light bg-dark">
        <a class="navbar-brand" href=".">INFOMAG</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mt-2 mt-lg-0 m-auto">
                <?php 
                    if(connected()) {
                        echo '
                        <form class="form-inline  my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <li class="nav-item active">
                            <a class="nav-link" href=".">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">';
                            $cat = showCategories();
                                foreach($cat as $catekey => $categories) {
                                    echo '<a class="dropdown-item" href="'.$_SERVER['PHP_SELF'].'?p=admin.liste&categoryId='.$categories['id'].'&categoriesName='.$categories['name'].'">'.$categories['name'].'</a>';
                                }
                        echo '
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger pl-4 pr-4" href="../controller/userController.php?act=disconnect">Disconnect</a>
                        </li>
                        ';
                    }
                    if(isset($adminConnected) && $adminConnected == true) {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="?p=admin.insert">inserer</a>
                            </li>
                        ';
                    }
                ?>
                
                <div class="d-flex flex-wrap registering">
                    <li class="nav-item mr-3">
                        <a class="nav-link btn btn-primary pl-4 pr-4" href="?p=front.user">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary pl-4 pr-4" href="?p=front.user">Sign In</a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
    </header>