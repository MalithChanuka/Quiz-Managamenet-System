<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']))
{
$user_id=$_GET['userId'];

}
 
$sql = "SELECT Q_id, exams_E_id, questionNo, question, answer1, answer2, answer3, answer4, correctAnswer,users_user_id FROM questions JOIN exams ON exams_E_id=E_id WHERE users_user_id=$user_id";
$result = $conn->query($sql);
$arr_questions = [];
if ($result->num_rows > 0) {
    $arr_questions= $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit_question</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<br>   
    <br>
    <?php include('message.php'); ?>

        <div class="row justify-content-center">
            <div class="col-md-11">
           <div class= "justify-content-md-end">
                    <div class="card-header">
                        <h4>Exam-Questions
                            <a href="teacher_exam.php?userId=<?=$user_id;?>" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
          </div>
         </div>
</div>
    <div class="container mt-5">
        <table id="usetTable" class="table">
            <thead>
                                <th>Q_id</th>
                                <th>exams_E_id</th>
                                <th>questionNo</th>
                                <th>question</th>
                                <th>Answer 1</th>
                                <th>Answer 2</th>
                                <th>Answer 3</th>
                                <th>Answer 4</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
            </thead>
            <tbody>
                <?php if(!empty($arr_questions)) { ?>
                    <?php foreach($arr_questions as $questions) { ?>
                        <tr>
                            <td><?php echo $questions['Q_id']; ?></td>
                            <td><?php echo $questions['exams_E_id']; ?></td>
                            <td><?php echo $questions['questionNo']; ?></td>
                            <td><?php echo $questions['question']; ?></td>
                            <td><?php echo $questions['answer1']; ?></td>
                            <td><?php echo $questions['answer2']; ?></td>
                            <td><?php echo $questions['answer3']; ?></td>
                            <td><?php echo $questions['answer4']; ?></td>
                            <td><?php echo $questions['correctAnswer']; ?></td>

                            <td>
                                <a href="Edit_question.php?id=<?= $questions['Q_id'];?>&userId=<?=$user_id;?>" class="btn btn-info btn-sm">Edit</a>
                                <form action="code.php?userId=<?=$user_id;?>" method="POST" class="d-inline">
                                <button type="submit" name="delete_question" value="<?=$questions['Q_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                </form>  
                           </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usetTable').DataTable();
        } );
    </script>
	<style>
	
.container {
    max-width:1220px;
    border: double;
}
	</style>
</body>
</html>