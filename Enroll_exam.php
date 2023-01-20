<?php 
    require_once('database.php');

    if (isset ($_GET['userId']))
    {
    $user_id=$_GET['userId'];

    }
  //pagination
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $num_per_page = 01;
    $start_from = ($page-1)*01;
    
    if(isset($_GET['id']))
    {
      $exam_id = mysqli_real_escape_string($conn, $_GET['id']);
      $query = "SELECT `Q_id`,`E_id`, `examName`,`e_duration`,`e_dateTime`, `questionNo`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correctAnswer`
                FROM  questions JOIN exams ON questions.exams_E_id= exams.E_id WHERE E_id='$exam_id' limit $start_from,$num_per_page";
      $result = mysqli_query($conn,$query);
    }  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Enroll_exam </title>
</head>
<body>
<h3><b>Enroll Exam</b></h3> 
<div class="text-center">
<h5><label class="col-sm-5 col-form-label " ><p id="timeLeft"> </p></label></h5>
</div>
<div class="col-md-8 mx-auto" >
        <div class=" card text-center">
            
            <div class="card-body">
       
                <?php 
                    while($row=mysqli_fetch_assoc($result))
                    {
                        
          $duration = $row['e_duration'];
          $dateTime = $row['e_dateTime']; 
          $endDateTime = date("Y-m-d H:i:s",(strtotime(date($dateTime))+$duration));
          $result_qid = $row ['Q_id'];
                ?>
                  
            <form method="POST" action="process.php?page=<?=$page;?>&id=<?=$exam_id;?>&userId=<?=$user_id?>">

            <label  hidden="hidden"id="enddateTime"><?php echo $endDateTime;?></label>    
                           <div class="card-header">
                        
                           <h3><lable01>Exam Name:<span class="label label-info"><?php echo $row['examName'];?></span></label01></h3>
                           </div> 

                         <?php
                           $query_st_answer = "SELECT st_answer FROM student_result WHERE result_userID=$user_id AND result_examID=$exam_id AND result_qID=$result_qid";

                           $query_run_st_answer = $conn->query($query_st_answer);
 
                           while($rRow=mysqli_fetch_array($query_run_st_answer))
                           {
                             $st_Ans =$rRow['st_answer'];
                           }
                         ?>
                         <!-- student given answer -->
                           <label hidden="hidden" id="givenAns"><?php echo $st_Ans;?></label>
                            
                           <input type="hidden" name="questions_Q_id" value="<?= $row ['Q_id'];?>" class="form-control" />
                                                        
                              <div class="text-center">
                                 <br>
                                  <h4><lable01><?php echo "(".$row['questionNo'].")";  echo ". ".$row['question']; ?></span></label01></h4>
                                 <br><br>
                                 <fieldset class="form-group">
                                    <div class="row">
                                       <legend class="col-form-label col-sm-4 pt-0">Select correct answer:</legend>
                                       <div class="col-sm-5">
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="st_answer" id="R1" value="1">
                                          <label class="form-check-label" for="gridRadios1">
                                          <?php echo $row['answer1'];?>
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="st_answer" id="R2" value="2">
                                          <label class="form-check-label" for="gridRadios2">
                                          <?php echo $row['answer2'];?>
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="st_answer" id="R3" value="3">
                                          <label class="form-check-label" for="gridRadios1">
                                          <?php echo $row['answer3'];?>
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="st_answer" id="R4" value="4">
                                          <label class="form-check-label" for="gridRadios2">
                                          <?php echo $row['answer4'];?>
                                          </label>
                                       </div>
                                       </div>  
                                    </div>
                                 </fieldset>
                                 </div>      
                        <?php 
                           }
                        ?>
        
                <div class="raw justify-content-center">
                <?php 
        
                $pr_query = "SELECT `Q_id`,`E_id`, `examName`,`e_duration`, `questionNo`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correctAnswer`
                             FROM  questions JOIN exams ON questions.exams_E_id= exams.E_id WHERE E_id='$exam_id'";
                $pr_result = mysqli_query($conn,$pr_query);
                $total_record = mysqli_num_rows($pr_result );
                
                $total_page = ceil($total_record/$num_per_page);

                if($page>1)
                {        
                    echo "<button name='exam_previous' type='submit' class='btn btn-danger'>Previous</button>";
                }
                
                for($i=1;$i<$total_page;$i++)
                {
                    //echo "<a href='Enroll_exam.php?page=".$i."&id=".$_GET['id']."' class='btn btn-primary'>$i</a>";
                } 

                if($i>$page)
                {
                    echo "<button name='exam_next' type='submit' class='btn btn-danger'>Next</button>";
                }
                ?>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="text-left">
                  <button type="submit" name="answerSave" class="btn btn-primary btn-sm">Save</button>
                  <button type="submit" name="examComplete" class="btn btn-secondary btn-sm">Complete</a></button>
                  </div>
                  </div>
           </form>

        </div>
    </div>
</div>

<script>
    //countdown timer
var countDownDate = new Date(document.getElementById('enddateTime').textContent).getTime();
var gAnswer = document.getElementById('givenAns').innerHTML;

//save student given answer-radio btn
var r1 =document.getElementById('R1');
var r2 =document.getElementById('R2');
var r3 =document.getElementById('R3');
var r4 =document.getElementById('R4');
if(gAnswer == 1)
{
    r1.checked=true;
}
else if(gAnswer == 2)
{
    r2.checked=true;
}
else if(gAnswer == 3)
{
    r3.checked=true;
}
else if(gAnswer == 4)
{
    r4.checked=true;
}

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
</script>

</body>
</html>