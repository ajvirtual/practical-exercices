<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/infomag_style.css">
      <link rel="stylesheet" href="css/listeByCategory.css">
<title> 
          <?php 
              if(isset($title)) {
                  echo 'infomag | '.$title;
              } else  echo 'infomag | home';
          ?>
      </title>
  
  </head>
  <body>
      <?php 
          $adminConnected = true;
          include_once('../view/header.php'); 
          echo $page;
      ?>
        
      <!-- <div class="container">
          <h1>BONJOUR TOUT LE MONDE</h1>
          <div id="place" class="d-none">
  
          </div>
          <button class="btn btn-outline-primary">cliquer pour tester</button>
      </div> -->
  
      <script src="js/Jquery.3.4.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  </body>
  </html>  