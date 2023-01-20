
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

    <title>New_exam</title>
</head>
<head>
      <!-- for dateTime picker -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('message.php'); ?>
    <div class="container" >
    <br>
    <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Exam
                            <a href="teacher_exam.php?userId=<?=$user_id;?>" class="btn btn-danger float-end">BACK</a>
                        </h5>
                    </div>
                    <div class="card-body">
                    <form action="code.php?userId=<?=$user_id;?>" method="POST">

                                    <div class="row mb-4">
                                            <div class="col">
                                            <div class="form-outline">
                                            <input type="text" hidden="hidden" name="users_user_id" value="<?= $user_id;?>" class="form-control" />
                                                
                                            </div>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="text" name="examName" required placeholder="Enter Exam Name" class="form-control" />   
                                            </div>
                                            </div>
                                            </div> 

                                        <div class="mb-3">

                                        <h4><label>Add Questions</label></h4>
                                        <br>
                                        <!-- always questions start with 1 -->
                                            <input type="text" hidden="hidden" name="questionNo" value="1"  class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" name="question" required placeholder="Enter Question" class="form-control">
                                        </div>
                                        <br>
                                        <div class="row mb-4">
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="text" name="answer1" required placeholder="Answer1" class="form-control" />
                                            
                                            </div>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">                                        
                                                <input type="text" name="answer2" required placeholder="Answer2" class="form-control" />
                                                
                                            </div>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="text" name="answer3" required placeholder="Answer3" class="form-control" />
                                                
                                            </div>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="text" name="answer4" required placeholder="Answer4"  class="form-control" />   
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
                                            <div class="dropdown">
                                            <div class="row">
                                            <label class="col-md-3 text-right">Set Duration:<span class="text-danger"></span></label>
                                            <div class="col-md-4">
                                            <select name="e_duration"  id="e_duration"  class="form-control">
                                                <option value="">set duration(min)</option>
                                                <option value="900">15 Min </option> 
                                                <option value="1800 ">30 Min</option>
                                                <option value="2700 ">45 Min</option>
                                                <option value="3600">60 Min</option>
                                            </select>
                                            </div>
                                        </div>
                                        <br>  
                                        <div class="row">
                                            <label class="col-md-3 text-right  ">Set ExamDate:<span class="text-danger" ></span></label>
                                        <div class="col-md-4">
                                            <input type="datetime-local" name="e_dateTime" class="form-control">
                                        </div>
                                    </div>

                                     <div class="d-grid gap-2 d-md-flex justify-content-md-end">    
                                     <button type="submit" name= "save_exam_question" class="btn btn-primary btn-sm">Save Exam</button>
                                     <button type="submit" name= "publish_exam_question" class="btn btn-secondary btn-sm">Publish Paper</button>
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
 


