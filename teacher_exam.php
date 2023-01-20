<?php
session_start();
require 'database.php';

if (isset ($_GET['userId']))
{
$user_id=$_GET['userId'];

}
$sql = "SELECT E_id, users_user_id, examName,examDate, status FROM exams where users_user_id=$user_id";
$result = $conn->query($sql);
$arr_exams = [];

if ($result->num_rows > 0) {
    $arr_exams = $result->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Teacher_exam</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<br>  
   
    <br>
    <?php include('message.php'); ?>

        <div class="row justify-content-center">
            <div class="col-md-9">
           <div class= "justify-content-md-end">
                    <div class="card-header">
                        <h4>Exams
                      <!-- logout -->
                    <form action="logout.php" method="POST">
                   
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="text-left">
                        <button  type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    
                    </h4>
                    </div>
          </div>
         </div>
</div>
    <div class="container mt-5">
        <table id="usetTable" class="table">
        </div>
                        <?php
                       echo "<a href=New_exam.php?userId=".$user_id." class='btn btn-primary float-end'>New Exam</a>";
                    //    echo "<a href=View_questions.php?userId=".$user_id." class='btn btn-warning float-end'>View Questions</a> ";
                        ?>
                    </div>
            <thead>
                                <th>Exam Name <a href=Add_questions.php?id=".$exams['E_id']."&userId=".$user_id."></a></th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
            </thead>
            <tbody>
                <?php if(!empty($arr_exams)) { ?>
                    <?php foreach($arr_exams as $exams) { ?>
                        <tr>
                            <td><?php echo $exams['examName']; ?></td>  
                            <td><?php echo $exams['examDate'];?></td>
                            
                            <td><?php  if($exams['status']=="0") 
                                          echo "Draft";
                                        else if($exams['status']=="1") 
                                          echo "Published";
                                        else
                                          echo "Ended";
                                          ?></td>
                                      
							<td>
                            <?php if($exams['status']=="1")
                                {
                                    echo "<a href=Moniter_started_exam.php?id=".$exams['E_id']." class='btn btn-info btn-sm'>View</a>";
                                } 
                                else if ($exams['status']=="0")
                                {
                                    echo "<a href=Add_questions.php?id=".$exams['E_id']."&userId=".$user_id." class='btn btn-success btn-sm'>Add</a>";
                                }
                                else 
                                echo "<a href=Moniter_started_exam.php?id=".$exams['E_id']." class='btn btn-info btn-sm'>View</a>";
                                ?>
                               
                                <form action="code.php?userId=<?=$user_id;?>" method="POST" class="d-inline">
                                <button type="submit"name="delete_exam" value="<?=$exams['E_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                             </form>
                             
                           </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
<!-- 
    <script type="text/javascript">
    function EnableDisable(txtPassportNumber) {
        //Reference the Button.
        var btnSubmit = document.getElementById("btnSubmit");
 
        //Verify the TextBox value.
        if (txtPassportNumber.value.trim() != "") {
            //Enable the TextBox when TextBox has value.
            btnSubmit.disabled = false;
        } else {
            //Disable the TextBox when TextBox is empty.
            btnSubmit.disabled = true;
        }
    }; -->
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
