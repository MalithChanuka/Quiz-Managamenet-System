
 <?php
session_start();
require 'database.php';

if (isset ($_GET['userId']))
    {
    $user_id=$_GET['userId'];

    }

// delete exams and questions using e_id in teacher_exam delete btn
if(isset($_POST['delete_exam']))
{
    $exam_id = mysqli_real_escape_string($conn, $_POST['delete_exam']);

    $query = "DELETE FROM exams WHERE E_id='$exam_id'";
    $query_run = mysqli_query($conn, $query);
  
    if($query_run)
    {
        $_SESSION['message']="Exam Deleted successfully";
        header('Location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Exam Not Deleted  ";
        header('Location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
}

//delete only question from view_question page
if(isset($_POST['delete_question']))
{
    $question_id = mysqli_real_escape_string($conn, $_POST['delete_question']);

    $query = "DELETE FROM questions WHERE Q_id='$question_id'";
    $query_run = mysqli_query($conn, $query);

    
    if($query_run)
    {
        $_SESSION['message']="Question Deleted successfully";
        header('Location:View_questions.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Question Not Deleted  ";
        header('Location:View_questions.php?userId='.$user_id);
        exit(0);
    }
}


// insert new exam with question in new_exam page, clicked- save exam button
if(isset($_POST['save_exam_question']))
{
    
    //insert data into exams table
    $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
    $examName = mysqli_real_escape_string($conn, $_POST['examName']);
    $e_duration = mysqli_real_escape_string($conn, $_POST['e_duration']);
    $e_dateTime = mysqli_real_escape_string($conn, $_POST['e_dateTime']);
    $status = false;
    //exam created date
    date_default_timezone_set('Asia/Colombo'); 
    $examdate = date('Y/m/d h:i A');

    //insert data into questions table
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    if($examName == "" || $question== "" ||$answer1 == "" || $answer2 == "" || $answer3 == "" || $answer4 =="" || $correctAnswer =="" || $e_duration == "" || $e_dateTime == "" ){
        
        $_SESSION['message']="please fill all the fields";
        header('location:New_exam.php?userId='.$user_id);
        
    }else
    {

        //insert data into exams table
    $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
    $examName = mysqli_real_escape_string($conn, $_POST['examName']);
    $e_duration = mysqli_real_escape_string($conn, $_POST['e_duration']);
    $e_dateTime = mysqli_real_escape_string($conn, $_POST['e_dateTime']);
    $status = false;
    //exam created date
    date_default_timezone_set('Asia/Colombo'); 
    $examdate = date('Y/m/d h:i A');

    $query = "INSERT INTO exams  (users_user_id,examName,examDate,e_duration,e_dateTime,status) values ('$users_user_id', '$examName','$examdate', '$e_duration','$e_dateTime',".($status?1:0) .")";

    $query_run =mysqli_query($conn, $query);

   // Get last insert id 
    $exams_E_id = mysqli_insert_id($conn); 

    echo "last id : ".$exams_E_id;

    //insert data into questions table
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    $query = "INSERT INTO questions  (exams_E_id,questionNo,question,answer1,answer2,answer3,answer4,correctAnswer) values ('$exams_E_id','$questionNo', '$question', '$answer1','$answer2','$answer3', '$answer4','$correctAnswer')";

    $query_run =mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message']="New exam created ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Exam Not created ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
}
}

// insert new exam with question in new_exam page ,clicked- publish paper button
if(isset($_POST['publish_exam_question']))
{

    //insert data to exams table
    $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
    $examName = mysqli_real_escape_string($conn, $_POST['examName']);
    $e_duration = mysqli_real_escape_string($conn, $_POST['e_duration']);
    $e_dateTime = mysqli_real_escape_string($conn, $_POST['e_dateTime']);
    $status = true;
    //exam created date
    date_default_timezone_set('Asia/Colombo'); 
    $examdate = date('Y/m/d h:i A');
    
    $query = "INSERT INTO exams  (users_user_id,examName,examDate,e_duration,e_dateTime,status) values ('$users_user_id', '$examName','$examdate', '$e_duration','$e_dateTime',".($status?1:0) .")";

    $query_run =mysqli_query($conn, $query);


   // Get last insert id 
    $exams_E_id = mysqli_insert_id($conn); 

    echo "last id : ".$exams_E_id; 


    //insert data into questions table
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    $query = "INSERT INTO questions  (exams_E_id,questionNo,question,answer1,answer2,answer3,answer4,correctAnswer) values ('$exams_E_id','$questionNo', '$question', '$answer1','$answer2','$answer3', '$answer4','$correctAnswer')";

    $query_run =mysqli_query($conn, $query);


    //update student exam_status as pending 
$sql = "SELECT `user_id` FROM users where user_type='student'";
$result = $conn->query($sql);
$arr_students = [];

if ($result->num_rows > 0) {
    $arr_students = $result->fetch_all(MYSQLI_ASSOC);
}
       
if(!empty($arr_students)) 
{ 
      foreach($arr_students as $students) 
      { 
        $studentId = $students['user_id'];

          $student_status ="INSERT INTO student_examstatus(`student_userId`, `student_examId`, `student_status`)VALUES ($studentId,$exams_E_id,0)";
          $query_run_status =mysqli_query($conn, $student_status);          
      } 
} 

    if($query_run_status)
    {
        $_SESSION['message']="New exam created & published ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Exam Not created ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }

    
}


//add new questions to existing exams by click save, exam_status=draft
if(isset($_POST['save_exam_Newquestion']))
{
   
    //insert data to exams table
    $exam_id= mysqli_real_escape_string($conn, $_POST['E_id']);
    $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
    $examName = mysqli_real_escape_string($conn, $_POST['examName']);
    $status = false;

    //insert data into questions table
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    //validation-all feilds must be filled
    if($examName == "" || $question== "" ||$answer1 == "" || $answer2 == "" || $answer3 == "" || $answer4 =="" || $correctAnswer ==""){
        
        $_SESSION['message']="please fill all the fields";
        header('location:Add_questions.php?userId='.$user_id);
        
    }else{

        $exam_id= mysqli_real_escape_string($conn, $_POST['E_id']);
        $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
        $examName = mysqli_real_escape_string($conn, $_POST['examName']);
        $status = false;
    
        //insert data into questions table
        $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
        $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
        $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
        $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
        $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);
    
    $query = "UPDATE exams  SET users_user_id='$users_user_id', examName='$examName', status=".($status?1:0) ." WHERE E_id='$exam_id'";
    $query_run =mysqli_query($conn, $query);


    $query = "INSERT INTO questions  (exams_E_id,questionNo,question,answer1,answer2,answer3,answer4,correctAnswer) values ('$exam_id','$questionNo', '$question', '$answer1','$answer2','$answer3', '$answer4','$correctAnswer')";
    $query_run =mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message']="New Question Added ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Question Not Add ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    }

    
}


//add new questions to existing exams by click publish paper,exam_status=published
if(isset($_POST['publish_exam_Newquestion']))
{
    //insert data to exams table
    $exam_id= mysqli_real_escape_string($conn, $_POST['E_id']);
    $users_user_id = mysqli_real_escape_string($conn, $_POST['users_user_id']);
    $examName = mysqli_real_escape_string($conn, $_POST['examName']);
    $status =true;

    $query = "UPDATE exams  SET users_user_id='$users_user_id', examName='$examName',status=".($status?1:0) ." WHERE E_id='$exam_id'";
    $query_run =mysqli_query($conn, $query);


    //insert data into questions table
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    $query = "INSERT INTO questions  (exams_E_id,questionNo,question,answer1,answer2,answer3,answer4,correctAnswer) values ('$exam_id','$questionNo', '$question', '$answer1','$answer2','$answer3', '$answer4','$correctAnswer')";

    $query_run =mysqli_query($conn, $query);


     //update student exam_status as pending 
    $student_st = "SELECT `user_id` FROM users where user_type='student'";
    $st_result = $conn->query($student_st);
    $arr_st_students = [];

    if ($st_result->num_rows > 0) {
        $arr_st_students = $st_result->fetch_all(MYSQLI_ASSOC);
    }
        
    if(!empty($arr_st_students)) 
    { 
        foreach($arr_st_students as $st) 
        { 
            $st_id = $st['user_id'];

            $student_status ="INSERT INTO student_examstatus(`student_userId`, `student_examId`, `student_status`)VALUES ($st_id,$exam_id,0)";
            $query_run_status =mysqli_query($conn, $student_status);          
        } 
    } 

    if($query_run)
    {
        $_SESSION['message']="New Question Added ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Question Not Add ";
        header('location:teacher_exam.php?userId='.$user_id);
        exit(0);
    }
}


// edit and save questions in view_question page
if(isset($_POST['edit_save_question']))
{
    $question_id = mysqli_real_escape_string($conn, $_POST['Q_id']);
    $questionNo = mysqli_real_escape_string($conn, $_POST['questionNo']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer1 = mysqli_real_escape_string($conn, $_POST['answer1']);
    $answer2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $answer3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    $answer4 = mysqli_real_escape_string($conn, $_POST['answer4']);
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    $query = "UPDATE questions SET questionNo='$questionNo', question='$question',answer1='$answer1',answer2='$answer2',
             answer3='$answer3',answer4='$answer4', correctAnswer='$correctAnswer' WHERE Q_id='$question_id'";

    $query_run =mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message']="Question Updated successfully";
        header('Location:View_questions.php?userId='.$user_id);
        exit(0);
    }
    else
    {
        $_SESSION['message']="Question Not Updated  ";
        header('Location:View_questions.php?userId='.$user_id);
        exit(0);
    }
}

?> 



