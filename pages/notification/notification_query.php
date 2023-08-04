<?php
error_reporting(0);

include("../../database/connection.php");


if(isset($_POST['view'])){
  $emp_id=$_POST['emp_id'];
  $cus_id=$_POST['cus_id'];
	$acc_type=$_POST['acc_type'];



  if($_POST["view"] == 'OP')
  {
  	
      $update_query = "UPDATE comments SET comment_status = 1 WHERE feedback_to = '$emp_id' AND comment_status=2";
      mysqli_query($con, $update_query);
  }

  if($_POST["view"] == 'OPview')
  {
    
      $query = "SELECT comment_subject, comment_text, DATE_FORMAT(feedback_date, '%m-%d-%Y %r')  as 'date' FROM comments WHERE feedback_to = '$emp_id' ORDER BY comment_id DESC LIMIT 5";

      $result = mysqli_query($con, $query);
      $output = '';

      if(mysqli_num_rows($result) > 0)
      {
       while($row = mysqli_fetch_array($result))
       {

         $output .= '
         <li class="noti-success">
            <div class="media">
              <div class="media-body">
                <p>LOT No. '.$row["comment_subject"].'</p><span>'.$row["comment_text"].'</span><br>
                <span>'.$row["date"].'</span>

              </div>
            </div>
          </li>
         ';

       }
      }
      else{
           $output .= '
           <li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
      }

      $status_query = "SELECT * FROM comments WHERE feedback_to = '$emp_id' AND comment_status=2";
      $result_query = mysqli_query($con, $status_query);
      $count = mysqli_num_rows($result_query);
      $data = array(
          'notification' => $output,
          'unseen_notification'  => $count
      );

      echo json_encode($data);
  }


  if($_POST["view"] == 'CUS')
  {
    
      $update_query = "UPDATE comments SET create_notif_status = 1 WHERE created_by = '$cus_id' AND create_notif_status=0";
      mysqli_query($con, $update_query);
  }

  if($_POST["view"] == 'CUSview')
  {
    
      $query = "SELECT comment_subject, create_text, DATE_FORMAT(create_date, '%m-%d-%Y %r')  as 'date' FROM comments WHERE created_by = '$cus_id' ORDER BY comment_id DESC LIMIT 5";

      $result = mysqli_query($con, $query);
      $output = '';

      if(mysqli_num_rows($result) > 0)
      {
       while($row = mysqli_fetch_array($result))
       {

         $output .= '
         <li class="noti-success">
            <div class="media">
              <div class="media-body">
                <p>LOT No. '.$row["comment_subject"].'</p><span>'.$row["create_text"].'</span><br>
                <span>'.$row["date"].'</span>

              </div>
            </div>
          </li>
         ';

       }
      }
      else{
           $output .= '
           <li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
      }

      $status_query = "SELECT * FROM comments WHERE created_by = '$cus_id' AND create_notif_status=0";
      $result_query = mysqli_query($con, $status_query);
      $count = mysqli_num_rows($result_query);
      $data = array(
          'notification' => $output,
          'unseen_notification'  => $count
      );

      echo json_encode($data);
  }

  

}


?>

