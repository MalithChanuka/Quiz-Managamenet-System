<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']) && isset($_GET['id']))
{
$user_id=$_GET['userId'];
$exam_id =$_GET['id'];
}

$examName ="SELECT examName FROM exams WHERE E_id=$exam_id";
$e_name= $conn->query($examName);

while($row=mysqli_fetch_array($e_name))
{
  $EexamName =$row['examName']; 
}

$query_getResult = "SELECT checkAnswer,questionNo FROM student_result  JOIN questions ON result_qID=Q_id WHERE exams_E_id=$exam_id AND result_userID=$user_id";

$getresult = $conn->query($query_getResult);

$arr_st_result = [];

if ($getresult->num_rows > 0) {
  $arr_st_result = $getresult->fetch_all(MYSQLI_ASSOC);
}

$countQuestions = "SELECT COUNT(questionNo) FROM questions WHERE exams_E_id=$exam_id";
$countq = $conn->query($countQuestions);
 
while($row=mysqli_fetch_array($countq))
{
  $Q_count =$row['COUNT(questionNo)'];
}

$count_stAns = "SELECT COUNT(st_answer) FROM student_result WHERE checkAnswer=1 AND result_examID=$exam_id AND result_userID=$user_id";
$countAns = $conn->query($count_stAns);
 
while($row=mysqli_fetch_array($countAns))
{
  $stAns_count =$row['COUNT(st_answer)'];
}
//calculate student score
$st_score = ($stAns_count/$Q_count)*100;

if($st_score >= 85)
{
  $status ='Pass';
  $resultA = 'A';
}
else if($st_score >= 65 && $st_score < 85)
{
  $status ='Pass';
  $resultA = 'B';
}
else if($st_score >= 45 && $st_score < 65)
{
  $status ='Pass';
  $resultA = 'C';
}
else if($st_score < 45)
{
  $status ='Fail';
  $resultA = 'F';
}
?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>View_results</title>
</head>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<?php
include 'database.php';
?>
<body>
<div class="row justify-content-center">
  <div class="col-sm-5">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">
        <lable01>Exam Name: <span><?php echo $EexamName?></span></label01></h3><br>
   
<div class="text-center"> 
  </div>
<div class="card  mx-auto">
  <div class="card-body">
  <h4><label class="col-sm-5 col-form-label " >Exam Completed!</label></h4>
    <h5 class="card-title"></h5>
    <br>
    <div class="text-center">
    <h2>Status: <span class="label label-default"><?php echo $status?></span></h2>
<br>  
    <h3><lable> Your Grade:<span class="label label-success"><?php echo $resultA?><span class="label label-success"><?php echo " =  "?><?php echo $st_score?></span></span></label></h3>
    <br>
    </div>
    <br>
    <button type="button" class="btn btn-secondary btn-sm">
<a href="student_exam.php?userId=<?=$user_id?>" class="btn btn-secondary btn-sm">Back</a>
</button> 
  </div>
</div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Questions</h4>
        <div class="container">
</div>
<div class="well">
    <h3>Feedback</h3>
    <hr />
   <?php
   
   if(!empty($arr_st_result)) 
    {
   foreach($arr_st_result as $st_res) 
   { 

    $st_a = $st_res['checkAnswer'];

    if($st_a == null)
    {
      $flag = "Not Answered";
      echo "<h4><label>Question ".$st_res['questionNo']." <span class='label label-warning'>".$flag."</span></label></h4><br>";
    }

    else if($st_a == 0)
    {
      $flag = "Wrong";
      echo "<h4><label>Question ".$st_res['questionNo']." <span class='label label-danger'>".$flag."</span></label></h4><br>";
    }
    else if($st_a == 1)
    {
      $flag = "Correct";
      echo "<h4><label>Question ".$st_res['questionNo']." <span class='label label-success'>".$flag."</span></label></h4><br>";
    }
    
   } 
  }
   ?>
</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>