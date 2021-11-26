<?php 
    require 'includes/doc.inc.php';
?>


<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>



<table style="width:100%">
  <tr>
    <th>first name</th>
    <th>last name</th>
    <th>schedule</th>
    <th>description</th>
  </tr>
  <?php 
    if(mysqli_num_rows($result_appointments) > 0){
        while($row = mysqli_fetch_array($result_appointments)){
         
?>
  <tr>
    <form method="post" action="doctorsAccepted.admin.php?action=add&id=<?php echo $row["appointment_id"]?>">
    <td><?php echo $row["client_fname"]; ?></td>
    <td><?php echo $row["client_lname"]; ?></td>
    <td><?php echo $row["client_schedule"]; ?></td>
    <td><?php echo $row["client_description"]; ?></td>

    <input type="hidden" name="hidden_name" value="<?php echo $row["client_fname"]; ?>">
    <input type="hidden" name="hidden_schedule" value="<?php echo $row["client_schedule"]; ?>">
    <input type="hidden" name="hidden_description" value="<?php echo $row["client_description"]; ?>">
    


    <td><input class="bttn-addCart" type="submit" value="accept" name="accept"/></td>
    </form>
  </tr>
  <?php 
            }
        }
  ?>
</table>


</body>