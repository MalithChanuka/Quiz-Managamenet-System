<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']) && isset($_GET['id']) && isset($_GET['page']))
{
    $user_id=$_GET['userId'];
    $exam_id =$_GET['id'];
    $page = $_GET['page'];
}
if(isset($_POST['exam_previous']))
{

    $questions_Q_id = mysqli_real_escape_string($conn, $_POST['questions_Q_id']);
    $st_answer = mysqli_real_escape_string($conn, $_POST['st_answer']);

    $query_correct = "SELECT correctAnswer FROM questions WHERE exams_E_id=$exam_id AND Q_id=$questions_Q_id";

    $query_run_crt = $conn->query($query_correct);

    while($row=mysqli_fetch_array($query_run_crt))
    {
    $correctAswer =$row['correctAnswer'];
    
    }
    //check the student answer with correct answer
    if($st_answer == $correctAswer)
    {
        $check=1;
    }
    else
    {
        $check=0;
    }

    $query_result = "UPDATE student_result SET st_answer=$st_answer, checkAnswer=$check  WHERE result_examID=$exam_id AND result_userID=$user_id AND result_qID=$questions_Q_id ";
    
    $query_run_result =mysqli_query($conn, $query_result);

    //update last question number/page
    $next_page=$page-1;
    $query_lst_page = "UPDATE student_examstatus SET last_question=$next_page WHERE student_examId= $exam_id AND student_userId=$user_id";

    $query_run_lst_page =mysqli_query($conn, $query_lst_page);

    header('location:Enroll_exam.php?page='.$next_page.'&id='.$exam_id.'&userId='.$user_id);   

}

if(isset($_POST['exam_next']))
{
    $questions_Q_id = mysqli_real_escape_string($conn, $_POST['questions_Q_id']);
    $st_answer = mysqli_real_escape_string($conn, $_POST['st_answer']);

    $query_correct = "SELECT correctAnswer FROM questions WHERE exams_E_id=$exam_id AND Q_id=$questions_Q_id";

    $query_run_crt = $conn->query($query_correct);

    while($row=mysqli_fetch_array($query_run_crt))
    {
    $correctAswer =$row['correctAnswer'];
    
    }
    //check the student answer with correct answer
    if($st_answer == $correctAswer)
    {
        $check=1;
    }
    else
    {
        $check=0;
    }

    $query_result = "UPDATE student_result SET st_answer=$st_answer, checkAnswer=$check  WHERE result_examID=$exam_id AND result_userID=$user_id AND result_qID=$questions_Q_id ";
    
    $query_run_result =mysqli_query($conn, $query_result);

    //update last question number/page
    $next_page=$page+1;
    $query_lst_page = "UPDATE student_examstatus SET last_question=$next_page WHERE student_examId= $exam_id AND student_userId=$user_id";

    $query_run_lst_page =mysqli_query($conn, $query_lst_page);

    header('location:Enroll_exam.php?page='.$next_page.'&id='.$exam_id.'&userId='.$user_id);

}

if(isset($_POST['answerSave']))
{
    $questions_Q_id = mysqli_real_escape_string($conn, $_POST['questions_Q_id']);
    $st_answer = mysqli_real_escape_string($conn, $_POST['st_answer']);

    $query_correct = "SELECT correctAnswer FROM questions WHERE exams_E_id=$exam_id AND Q_id=$questions_Q_id";

    $query_run_crt = $conn->query($query_correct);

    while($row=mysqli_fetch_array($query_run_crt))
    {
    $correctAswer =$row['correctAnswer'];
    
    }
     //update last question number/page
    if($st_answer == $correctAswer)
    {
        $check=1;
    }
    else
    {
        $check=0;
    }
    $query_result = "UPDATE student_result SET st_answer=$st_answer, checkAnswer=$check  WHERE result_examID=$exam_id AND result_userID=$user_id AND result_qID=$questions_Q_id ";
    
    $query_run_result =mysqli_query($conn, $query_result);

    //update last question numberpage
    $next_page=$page;
    $query_lst_page = "UPDATE student_examstatus SET last_question=$next_page WHERE student_examId= $exam_id AND student_userId=$user_id";

    $query_run_lst_page =mysqli_query($conn, $query_lst_page);

    header('location:student_exam.php?userId='.$user_id);
}

if(isset($_POST['examComplete']))
{
    $questions_Q_id = mysqli_real_escape_string($conn, $_POST['questions_Q_id']);
    $st_answer = mysqli_real_escape_string($conn, $_POST['st_answer']);

    $query_correct = "SELECT correctAnswer FROM questions WHERE exams_E_id=$exam_id AND Q_id=$questions_Q_id";

    $query_run_crt = $conn->query($query_correct);

    while($row=mysqli_fetch_array($query_run_crt))
    {
    $correctAswer =$row['correctAnswer'];
    
    }
     //update last question number/page
    if($st_answer == $correctAswer)
    {
        $check=1;
    }
    else
    {
        $check=0;
    }
    $query_result = "UPDATE student_result SET st_answer=$st_answer, checkAnswer=$check  WHERE result_examID=$exam_id AND result_userID=$user_id AND result_qID=$questions_Q_id ";
    
    $query_run_result =mysqli_query($conn, $query_result);

    //update last question number/page
    $next_page=$page;
    $query_lst_page = "UPDATE student_examstatus SET last_question=$next_page WHERE student_examId= $exam_id AND student_userId=$user_id";

    $query_run_lst_page =mysqli_query($conn, $query_lst_page);

    
$query_st_update = "UPDATE student_examstatus  SET student_status=2 WHERE student_userId=$user_id AND student_examId=$exam_id";
$query_run_st_update =mysqli_query($conn, $query_st_update);


    header('location:View_result.php?userId='.$user_id.'&id='.$exam_id); 
}
?>








