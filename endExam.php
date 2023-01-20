<?php
require 'database.php';
if(isset($_GET['examId']) || isset($_GET['userId']))
{
   $exam_id = $_GET['examId'];
   $user_id = $_GET['userId'];
//set the student exam_status as finished
    $query = "UPDATE exams SET `status`= 2 where E_id=$exam_id";
    $query_run =mysqli_query($conn, $query);

 if($query_run)
    {
        $_SESSION['message']="Exam ended!";
        header('location:teacher_exam.php?userId='.$user_id);
       
    }
    else
    {
        $_SESSION['message']="Exam not Ended!";
        header('location:teacher_exam.php?userId='.$user_id);
       
    } 
    $conn->close();
 
}
?>