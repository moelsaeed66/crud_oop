<?php
global $db;
include('header.php');?>
<center>
    <h1>all employees</h1>
</center>

<table id="employeeTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Department</th>
    </tr>
    </thead>
    <tbody id="employeeList">
    <?php foreach ($db->selectAllData('employees') as $row):?>
    <tr>
        <td><?= $row['name'];?></td>
        <td><?= $row['department'];?></td>
        <td><a href="delete_employee.php? id=<?=$row['id'];?>" class='button'>delete</a></td>
        <td><a href="edit_employee.php? id=<?=$row['id'];?>" >edit</a></td>



    </tr>
    <?php endforeach;?>
    </tbody>
</table>




<?php include('footer.php');?>

