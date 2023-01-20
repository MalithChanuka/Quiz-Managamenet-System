
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
    <title>Edit_question</title>
</head>
<head>
      <!-- for dateTime picker -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" >
    <br>
    <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit question
                            <a href="View_questions.php?userId=<?=$user_id;?>" class="btn btn-danger float-end">BACK</a>
                        </h5>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                               $question_id = mysqli_real_escape_string($conn, $_GET['id']);
                             
                               $query = "SELECT `Q_id`, `exams_E_id`, `questionNo`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correctAnswer` FROM questions WHERE Q_id= $question_id";
                               $query_run = mysqli_query($conn, $query);

                               if(mysqli_num_rows($query_run)>0)
                               {
                                 $question =mysqli_fetch_array($query_run);
                                 ?>
                                    <form action="code.php?userId=<?=$user_id;?>" method="POST">

                                                <div class="row mb-4">
                                                        
                                                        <input type="hidden"   name="Q_id" value="<?= $question['Q_id'];?>" class="form-control" />
                                                        
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example2">Exam ID:</label>
                                                            <input disabled type="text"  name="exams_E_id" value="<?= $question['exams_E_id'];?>" class="form-control" />
                                                            
                                                        </div>
                                                        </div>
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example1">Question No:</label>
                                                            <input type="text" name="questionNo" value="<?= $question['questionNo'];?>" class="form-control" />
                                                        
                                                        </div>
                                                        </div>
                                                        
                                                        </div> 

                                                    <div class="mb-3">

                                                    <h4><label>Edit Questions</label></h4>
                                                    <br>
                                                      
                                                        <label>Question:</label>
                                                        <input type="text" name="question" value="<?= $question['question'];?>" class="form-control">
                                                    </div>
                                                    <br>
                                                    <div class="row mb-4">
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example1">Answer1:</label>
                                                            <input type="text" name="answer1" value="<?= $question['answer1'];?>" class="form-control" />
                                                        
                                                        </div>
                                                        </div>
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example2">Answer2:</label>
                                                            <input type="text" name="answer2" value="<?= $question['answer2'];?>"  class="form-control" />
                                                            
                                                        </div>
                                                        </div>
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example1">Answer3:</label>
                                                            <input type="text" name="answer3" value="<?= $question['answer3'];?>" class="form-control" />
                                                            
                                                        </div>
                                                        </div>
                                                        <div class="col">
                                                        <div class="form-outline">
                                                        <label class="form-label" for="form6Example2">Answer4:</label>
                                                            <input type="text" name="answer4" value="<?= $question['answer4'];?>" class="form-control" />     
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown">
                                                    <div class="row ">
                                                    <label class="col-md-3 text-right  ">Select Correct Answer:<span class="text-danger" ></span></label>
                                                    <div class="col-md-4" >
                                                        <select name="correctAnswer" value="<?= $question['correctAnswer'];?>" id="answer_option" class="form-control">

                                                            <option value="">Select</option>
                                                            <option value="1">answer1</option>
                                                            <option value="2">answer2</option>
                                                            <option value="3">answer3</option>
                                                            <option value="4">answer4</option>
                                                        </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                                        <button type="submit" name= "edit_save_question" class="btn btn-primary btn-sm">Save</button>
                                                        
                            
                                                        </div>

                                    </form>
                                    <?php
                                 
                                }
                                else
                                {
                                  echo "</h4>no data</h4>";
                                }
                         }?>

                            </div>
                         </div>
                       </div>
                   </div>
              </div>
          
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>



