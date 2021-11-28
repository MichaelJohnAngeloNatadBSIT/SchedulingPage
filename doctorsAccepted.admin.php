<?php 
    require 'includes/doc.inc.php';
?>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<link rel="stylesheet" type="text/css" href="style.css"/>
<h1>Accepted Appointments</h1>
<body>
    <table style="width:100%">
    <tr>
        <th>name</th>
        <th>schedule</th>
        <th>description</th>
    </tr>
    <?php 
        if(!empty($_SESSION["cart"])){
            foreach ($_SESSION["cart"] as $key => $values){
                $item_name_arr[] = $values["client_name"];
            
    ?>
    <tr>
       
        <td><?php echo $values["client_name"]; ?></td>
        <td><?php echo $values["client_schedule"]; ?></td>
        <td><?php echo $values["client_description"]; ?></td>
        
        <td>
            <a href="doctorsAccepted.admin.php?action=delete&id=<?php echo $values["appointment_id"];?>"> 
                <input type="button" class="bttn-remove" value="REMOVE"/>
            </a>
        </td>

    </tr>
    <?php 
                }
            }
    ?>
    </table>
</body>