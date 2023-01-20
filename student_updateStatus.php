<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']) && isset($_GET['id']))
{
$user_id=$_GET['userId'];
$exam_id =$_GET['id'];

//student enroll exam
$query_update = "UPDATE student_examstatus  SET student_status=1 WHERE student_userId=$user_id AND student_examId=$exam_id";
$query_run =mysqli_query($conn, $query_update);

//get last question to continue from stopped question
$query_select ="SELECT last_question from student_examstatus WHERE student_userId=$user_id AND student_examId=$exam_id";
$ls_question = $conn->query($query_select);

while($row=mysqli_fetch_array($ls_question))
{
  $lqn =$row['last_question'];
  
}
//insert student exam record when enrolling
$result = "SELECT * FROM student_result WHERE result_examID=$exam_id AND result_userID=$user_id";
$ls_result = $conn->query($result);

      if ($ls_result->num_rows == 0) 
    {
         
        $ls_questions = "SELECT Q_id FROM questions WHERE exams_E_id=$exam_id "; 
        
        $st_q = $conn->query($ls_questions);
        $arr_st_question = [];

    if ($st_q->num_rows > 0) {
        $arr_st_question = $st_q->fetch_all(MYSQLI_ASSOC);
    }

    if(!empty($arr_st_question)) 
    { 
        foreach($arr_st_question as $qt) 
        { 
            $q_id = $qt['Q_id'];

            $question_st ="INSERT INTO student_result (`result_examID`, `result_userID`, `result_qID`) VALUES ('$exam_id','$user_id','$q_id')";
           $query_question = mysqli_query($conn, $question_st);
        } 
      
    } 
    
  }
header('location:Enroll_exam.php?page='.$lqn.'&id='.$exam_id.'&userId='.$user_id);

}

?>

