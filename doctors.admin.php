<?php 
    require 'includes/doc.inc.php';
?>


<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h1>Doctor Side Accepting Appointment</h1>


<table style="width:100%">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Phone Number</th>
    <th>Email</th>
    <th>Address</th>
    <th>Description</th>
    <th>Schedule</th>
  </tr>
  <?php 
    if(mysqli_num_rows($result_appointments) > 0){
        while($row = mysqli_fetch_array($result_appointments)){
         
?>
  <tr>
    <form method="post" action="doctorsAccepted.admin.php?action=add&id=<?php echo $row["appointment_id"]?>">
    <td><?php echo $row["client_fname"]; ?></td>
    <td><?php echo $row["client_lname"]; ?></td>
    <td><?php echo $row["client_gender"]; ?></td>
    <td><?php echo $row["client_number"]; ?></td>
    <td><?php echo $row["client_email"]; ?></td>
    <td><?php echo $row["client_address"]; ?></td>
    <td><?php echo $row["client_schedule"]; ?></td>
    <td><?php echo $row["client_description"]; ?></td>

    <input type="hidden" name="hidden_name" value="<?php echo $row["client_fname"]; $row["client_lname"];?>">
    <input type="hidden" name="hidden_schedule" value="<?php echo $row["client_schedule"]; ?>">
    <input type="hidden" name="hidden_description" value="<?php echo $row["client_description"]; ?>">
    <input type="hidden" name="hidden_number" value="<?php echo $row["client_number"]; ?>">
    <input type="hidden" name="hidden_address" value="<?php echo $row["client_address"]; ?>">
    <input type="hidden" name="hidden_email" value="<?php echo $row["client_email"]; ?>">

    


    <td><input class="bttn-addCart" type="submit" value="accept" name="accept"/></td>
    </form>
  </tr>
  <?php 
            }
        }
  ?>
</table>


</body>