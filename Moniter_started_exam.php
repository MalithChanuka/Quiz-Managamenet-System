<!doctype html>
<html lang="en">
<head>   
<meta charset="utf-8">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Moniter_started_exam</title>
</head>
<head>

<!-- card style -->
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- start/end time style -->
<link rel ="stylesheet" href ="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script src ="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

   <!-- table style -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<?php
include 'database.php';
?>
<?php
 if(isset($_GET['id']))
 {
        $exam_E_id = mysqli_real_escape_string($conn, $_GET['id']);
      
        $query = "SELECT `e_duration`,`e_dateTime`,`users_user_id`,`examName`,`status` FROM exams WHERE E_id= $exam_E_id ";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run)>0)
        {
          $exam =mysqli_fetch_array($query_run);
          
          $duration = $exam['e_duration'];
          $dateTime = $exam['e_dateTime']; 
          $endDateTime = date("Y-m-d H:i:s",(strtotime(date($dateTime))+$duration));
          $user_id = $exam['users_user_id'];
          $examName = $exam['examName'];
          $checkstatus = $exam['status'];
        }
      }

      $sql = "SELECT userName,`user_id`,student_status FROM student_examstatus JOIN users ON `user_id`= student_userId where student_examId=$exam_E_id";
      $result = $conn->query($sql);
      $arr_students = [];

      if ($result->num_rows > 0) {
          $arr_students = $result->fetch_all(MYSQLI_ASSOC);
      }
 
$countStudent = "SELECT COUNT(userName) FROM users WHERE user_type='student'";
$count = $conn->query($countStudent);
 
while($row=mysqli_fetch_array($count))
{
  $stcount =$row['COUNT(userName)'];
}

$completion = "SELECT COUNT(student_status) FROM student_examstatus WHERE student_status=2 AND student_examId=$exam_E_id";
$st_complete = $conn->query($completion);
 
while($row=mysqli_fetch_array($st_complete))
{
  $complete_count =$row['COUNT(student_status)'];
}

?>

<body>
<br><br><br>
<div class="text-center">
  <label hidden="hidden" id="status"> <?php echo $checkstatus;?></label>

   <h3><lable01>Exam Name: <span class="label label-info"><?php echo $examName;?></span></label01></h3><br> 
   <label hidden="hidden" id="enddateTime"> <?php echo $endDateTime;?></label>
</div>
<br><br>
<div class="row justify-content-center">
  <div class="col-sm-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><b>Exam Completed</b></h5>
        <div class="text-center">
          <!-- get count of student and completed students -->
        <h2>Completion: <span class="label label-default"><?php echo $complete_count?><?php echo "/"?><?php echo $stcount?></span></h2>
        </div>


        <h5><label text-align="center" class="col-sm-5 col-form-label"><p id="timeLeft"></p></label></h5>
        <br><br><br>
<h4> Exam started Time: <span class ="label label-primary"><?php echo $dateTime;?>  </span></h4>
<h4> Exam ending Time: <span class ="label label-primary"><?php echo $endDateTime;?></span></h4><br><br>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><b>Attending Students Lists</b></h5>
       <br>
        <table class="table">
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Exam Status</th>
        
      </tr>
    </thead>
    <tbody>
    <!--student list to display-->
    <?php if(!empty($arr_students)) { ?>
              <?php foreach($arr_students as $students) {?>    
                 <tr>
                    <td><?php if($students['student_status'] =="0" || $students['student_status'] == "1") 
                                          echo $students['userName'];

                                        else if($students['student_status'] == "2") 
                                        echo "<a href='View_result.php?id=".$exam_E_id."&userId=".$students['user_id']."'>".$students['userName']."</a>";?></td>  
                                        
                    <td><?php if($students['student_status'] =="0" || $students['student_status'] == "1") 
                                          echo "Not Completed";

                                        else if($students['student_status'] == "2") 
                                        echo "Completed";
                                         ?></td>
                 </tr>
                          
           <?php } ?>
   <?php } ?>
    </tbody>
  </table>
  <br>
      </div>
    </div>
  </div>
</div>
<div class="text-center">
<button id="btnend" type="button" class="btn btn-danger">
<a href="endExam.php?examId=<?=$_GET['id'];?>&userId=<?=$user_id;?>" class="btn btn-danger">End Exam</a></button>
<a href="teacher_exam.php?&userId=<?=$user_id;?>" class="btn btn-primary">Back</a>
</div>

<script>
  var status = document.getElementById('status').innerHTML;
  if(status != 2)
  {
var countDownDate = new Date(document.getElementById('enddateTime').textContent).getTime();
var btnend = document.getElementById('btnend');
var x = setInterval(function() {

// Get today's date and time
var now = new Date().getTime();

// Find the distance between now and the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Display the result in the element
document.getElementById("timeLeft").innerHTML = "Time Left : " + days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";

// If the count down is finished, write some text
if (distance < 0) {
clearInterval(x);
//click to end exam
btnend.click();
document.getElementById("timeLeft").innerHTML = "Time Left : EXPIRED";
}
}, 1000);
}
else{
//when exam end countdown timer stop
  document.getElementById("timeLeft").innerHTML = "ENDED";
  document.getElementById("btnend").style.visibility = 'hidden';
}
</script>
</body>
</html>