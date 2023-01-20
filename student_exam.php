
<?php
require_once('database.php');

if (isset ($_GET['userId']))
{
$user_id=$_GET['userId'];

}
 //display only published exams
$sql = "SELECT  E_id,examName, e_duration, e_dateTime,status FROM  exams WHERE status='1' ";

$result = $conn->query($sql);
$arr_exams = [];
if ($result->num_rows > 0) {
    $arr_exams = $result->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>student_exam</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<br>  
    <br>
    <?php include('message.php'); ?>

        <div class="row justify-content-center">
            <div class="col-md-9">
           <div class= "justify-content-md-end">
                    <div class="card-header">
                        <h4>Student-Scheduled exams</h4>
                         <!-- logout  -->
                    <form  style="align:left;" action="logout.php" method="POST">
                        <button  type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                    </div>
          </div>
         </div>
</div>
    <div class="container mt-5">
        <table id="usetTable" class="table">
            <thead>
                                
                                <th>Exam Name</th>
                                <th>Duration (min)</th>
                                <th>Starting time</th>
                                <th>Status</th>
                                <th>Actions</th>
            </thead>
            <tbody>
                <?php if(!empty($arr_exams)) { ?>
                    <?php foreach($arr_exams as $exams) {

                        $student_exam_id = $exams['E_id'];
                        //get student exam_status(pending/enrolled/finished)
                         $student_status ="SELECT student_status FROM student_examStatus WHERE student_userId=$user_id AND student_examId= $student_exam_id";
                         $studentEid = $conn->query($student_status);

                         while($row=mysqli_fetch_array($studentEid))
                        {
                        $student_st =$row['student_status'];
                        }
                        ?>
                        <tr>
                            <td><?php echo $exams['examName']; ?></td>
                            <td><?php echo $exams['e_duration']; ?></td>
                            <td><label class="startdate"><?php echo $exams['e_dateTime']; ?></label></td>
                            <td><?php if($student_st=="0") 
                                          echo "Pending";

                                        else if($student_st=="1") 
                                        echo "enrolled";

                                        else
                                        echo "finished";
                                         ?></td>
                            <td> 
                             <?php
                             if($student_st=="0")
                             {
                                echo "<div class='btnstart'><button type='submit' name='btnStart' class='btn btn-success btn-sm'><a href='student_updateStatus.php?id=".$exams['E_id']."&userId=".$user_id."' class='btn btn-success btn-sm'>Start</a> </button></div>";
                             }

                             else if($student_st=="1") 
                             {
                                echo "<div class='btnstart'><button type='submit' name='btnStart' class='btn btn-success btn-sm'><a href='student_updateStatus.php?id=".$exams['E_id']."&userId=".$user_id."' class='btn btn-success btn-sm'>Start</a> </button></div>";
                             }
                             
                             else if($student_st=="2")
                             {
                                echo "<button type='submit' name='btnviewResult' class='btn btn-warning btn-sm'><a href='View_result.php?id=".$exams['E_id']."&userId=".$user_id."' class='btn btn-warning btn-sm'>View</a> </button>";
                                
                             }
                                ?>
                          </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        //exam started date value
        var elements = document.getElementsByClassName("startdate");
        //exam started 
        var btns = document.getElementsByClassName("btnstart");
        var btnviews = document.getElementsByClassName("btnviewResult");
        for(var e = 0; e < elements.length; e++) { 
               var element = elements[e];
               var btn = btns[e];
               var btnview =btnviews[e]; 
               var startdate = new Date(element.innerHTML).getTime();
               var now = new Date().getTime();
                if (now < startdate){
                    //hide the start btn when date is upcoming day
                   btn.setAttribute('hidden','hidden');
                }
            }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usetTable').DataTable();
        } );
    </script>

	<style>
.container {
    max-width:1020px;
    border: double;
}
	</style>
    
</body>
</html>






































