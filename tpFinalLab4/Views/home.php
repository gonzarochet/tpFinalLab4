
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hero</title>
    <link href="baseStyle.css" rel="stylesheet" media="all"> 
</head>
<body>
     <div class = "card-home">
          <div class = "card-content">
               <div id="pic">
                    <picture>
                         <source srcset"" media="">
                         <img src = "/images/petHeroLogo.png" class = "card-content-pic">
                    </picture>
               </div>
               <div class = "card-content-text">
                    <form action = "<?php echo FRONT_ROOT ?>Home/Login" method = "POST">
                         <div>
                              <h1>Login</h1>
                         </div>
                         <div class = "form-content"> 
                              <label for = "username">Enter your Email</label>
                              <br>
                              <input type="text" name = "username"> 
                              <span class = "error"><//?php echo $errUsername;?></span>
                         </div>
                         <div class = "form-content"> 
                              <label for = "password">Enter your Password</label>
                              <br>
                              <input type="password" name = "password"> 
                              <span class = "error"><//?php echo $errPassword;?></span>
                         </div>
                         <div class = "button-form">
                              <input type="submit" href = "<?php echo FRONT_ROOT ?>Home/Login" value= "Login" ></input>
                         </div>
                         <hr>
                         <div class = "button-form">
                              <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/ShowAddView">Register</a>
                         </div>

                    </form>
               </div>
          </div>
     
     </div>
   
</body>
</html>
