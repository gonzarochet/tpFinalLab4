
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
    <link href="<?php echo CSS_PATH?>/styles.css" rel="stylesheet" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body> 
     <?php include("nav.php");?>
     <div class = "card-home">
          <div class = "card-content">
               <div id="pic">
                    <picture>
                         <source srcset"" media="">
                         <img src = "<?php echo IMAGES_PATH?>/petHeroLogo" class = "card-content-pic">
                    </picture>
               </div>
               <div class = "card-content-text">
                    <form action = "<?php echo FRONT_ROOT ?>User/Login" method = "POST">
                         <div>
                              <h1>Login</h1>
                         </div>
                         <div class = "form-content"> 
                              <label for = "username">Enter your Email</label>
                              <br>
                              <input type="text" name = "email" required> 
                         </div>
                         <div class = "form-content"> 
                              <label for = "password">Enter your Password</label>
                              <br>
                              <input type="password" name = "password" required> 
                              <span class = "error"><?php echo @$message?></span>
                         </div>
                         <div class = "button-form">
                              <input id="button" type="submit" href = "<?php echo FRONT_ROOT ?>User/Login" value= "Login" ></input>
                         </div>
                         <p>or...</p>
                         <div class = "button-form">
                              <a href="<?php echo FRONT_ROOT ?>User/ShowAddView">Register</a>
                         </div>
                    </form>
               </div>
          </div>
     
     </div>
   
</body>
</html>
