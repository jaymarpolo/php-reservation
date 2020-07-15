<?php  
if(isset($_POST["from_date"], $_POST["to_date"]))  
{  
  $conn = new mysqli('localhost', 'root', '', 'ers')or die(mysqli_error($conn));
  $output = '';
  $query = "SELECT * FROM tbl_reserve WHERE status = 'Finished' AND balance = '0.00' AND datecompleted BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
  $result = mysqli_query($conn, $query);  
  $output .= '
  <table class="table table-bordered">  
  <tr>
  <th>Fullname</th>
  <th>Event Name</th>
  <th>Event Type</th>
  <th>Date Completed</th>
  <th>Amount</th>
  </tr>';  
  if(mysqli_num_rows($result) > 0){
   while($row = mysqli_fetch_array($result))  
   {
    $output .= '
    <tr>
    <td>'. $row["fullname"] .'</td>
    <td>'. $row["event_name"] .'</td>
    <td>'. $row["event_type"] .'</td>
    <td>'. date('F d, Y', strtotime($row["datecompleted"])) .'</td>
    <td>'. $row["payable"] .'</td>
    </tr>';
  }
}
$output .= '</table>';
echo $output;
}
?>