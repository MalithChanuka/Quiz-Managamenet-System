
<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']))
{
$user_id=$_GET['userId'];

}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> 

    <title>Add_question</title>
</head>
<body>
<?php include('message.php'); ?>
 <div class="container mt" >
    <br>
    <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Question
                            <a href="teacher_exam.php?userId=<?=$user_id;?>" class="btn btn-danger float-end">BACK</a>
                        </h5>
                    </div>
                    <div class="card-body">
                      <?php
                        if(isset($_GET['id']))
                        {
                               $exam_id = mysqli_real_escape_string($conn, $_GET['id']);
                             
                               $query = "SELECT `E_id`,`users_user_id`,`examName` FROM exams WHERE E_id= $exam_id";
                               $query_run = mysqli_query($conn, $query);

                               if(mysqli_num_rows($query_run)>0)
                               {
                                 $question =mysqli_fetch_array($query_run);
                                ?>
                        <form action="code.php?userId=<?=$user_id;?>" method="POST">

                                            <div class="row mb-4">
                                           
                                            <input type="hidden" name="E_id" value="<?= $question['E_id'];?>" class="form-control" />
                                            <input type="text" hidden="hidden" name="users_user_id" value="<?= $question['users_user_id'];?>" class="form-control" />
                                                    
                                                    <div class="col">
                                                    <div class="form-outline">
                                                    <label class="form-label">Exam Name:</label>
                                                    <input type="text" name="examName" value="<?= $question['examName'];?>" class="form-control" />
                                                        
                                                    </div>
                                                    </div>
                                                    </div> 
                                 <?php
                                }
                                else
                                {
                                  echo "</h4>no data</h4>";
                                }
                           }?>
                                <?php
                                if(isset($_GET['id']))
                                {
                                       $exam_E_id = mysqli_real_escape_string($conn, $_GET['id']);
                                     
                                       $queryQue = "SELECT `questionNo`,`Q_id` FROM questions WHERE exams_E_id= $exam_E_id  order by Q_id desc limit 1";
                                       $query_runQue = mysqli_query($conn, $queryQue);
        
                                    
                                       if(mysqli_num_rows($query_runQue)>0)
                                       {
                                         $questionNo =mysqli_fetch_array($query_runQue);

                                         $QN = $questionNo['questionNo']+1;

                                ?>
                                <?php
                                }
                            }?>
                                                <div class="mb-3">

                                                <h4><label>Add Questions</label></h4>
                                                <br>
                                                <!-- set exam questionNo using increment value -->
                                                    <input type="text" hidden="hidden" name="questionNo" value="<?=$QN;?>" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Question:</label>
                                                    <input type="text" name="question" class="form-control">
                                                </div>
                                                <br>
                                                <div class="row mb-4">
                                                    <div class="col">
                                                    <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Answer1:</label>
                                                        <input type="text" name="answer1" class="form-control" />
                                                    
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                    <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Answer2:</label>
                                                        <input type="text" name="answer2" class="form-control" />
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                    <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Answer3:</label>
                                                        <input type="text" name="answer3" class="form-control" />
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="col">
                                                    <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Answer4:</label>
                                                        <input type="text" name="answer4" class="form-control" />
                                                        
                                                    </div>
                                                    </div>
                                                </div>

                                                <div class="dropdown">
                                                <div class="row ">
                                                <label class="col-md-3 text-right  ">Select Correct Answer:<span class="text-danger" ></span></label>
                                                <div class="col-md-4" >
                                                    <select name="correctAnswer" id="answer_option" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1">answer1</option>
                                                        <option value="2">answer2</option>
                                                        <option value="3">answer3</option>
                                                        <option value="4">answer4</option>
                                                    </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                            
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button type="submit" name= "save_exam_Newquestion" class="btn btn-primary btn-sm">Save Exam</button>
                                                    <button type="submit" name= "publish_exam_Newquestion" class="btn btn-secondary btn-sm">Publish Paper</button> 
                                                    </div>
                        </form>
                        </div>
                    </div>
                </div>
              </div>
          </div>
          
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>