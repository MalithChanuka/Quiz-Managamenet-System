<?php
session_start();
include 'database.php';

if(isset($_POST['submit']))
{

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];

   echo "<div>'$email' '$pass'</div>";
   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
      $userType = $row['user_type'];
      $user_id = $row['user_id'];

      //redirect correct user_view_page by checking user_type 
      echo "<div>'$userType'</div>";
      if($row['user_type'] == 'teacher'){

        header('location:teacher_exam.php?userId='.$user_id); 

      }elseif($row['user_type'] == 'student'){

        header('location:student_exam.php?userId='.$user_id);

      }
     
   }else{

    header('location:login.php?remarks=success');
      
   }
}
$conn->close();
?>