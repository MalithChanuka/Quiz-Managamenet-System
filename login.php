
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="checkLogin.php" method="post">
      <!-- <h3>login now</h3> -->
    
      <!-- validating correct login credentials -->
         <?php
         if (isset ($_GET['remarks']))
         {
         $remarks=$_GET['remarks'];
         if ($remarks==null and $remarks=="")
         {
         echo 'Enter Username and Password';
         }
         if ($remarks=='success')
         {
            echo '<label style="color: red;"> Incorrect Email or Password! </label>';
         }
         }
         ?>
      <label class="userN" for="username">Email Address</label>   
      <input type="email" autocomplete="off" name="email" required placeholder="Email Address">
      <label class="userP" for="username">Password</label>
      <input type="password"  autocomplete="off" name="password" required placeholder="Password">
      <input type="submit" name="submit" value="Sign In" class="form-btn">
      <!-- <p>don't have an account? <a href="register_form.php">register now</a></p> -->
   </form>

</div>

</body>
</html>
