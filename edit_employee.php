<?php include('header.php');
global $db;
$id=$_GET['id'];

?>



<?php  $row = $db->selectOne('employees',$id); ?>
<?php if(isset($id) && is_numeric($id) && $row):  ?>

    <?php
    $departmentes = array("it","cs","is");
    $error = '';
    $success = '';
    ?>


    <?php

    if(isset($_POST['submit']))
    {
        $name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email      = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $department = filter_var($_POST['department'],FILTER_SANITIZE_STRING);

        if(empty($name) or empty($email) or empty($department))
        {
            $error = "Please Fill All Fields";
        }
        else
        {
            if(strlen($name) > 3)
            {
                if(filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    $department = strtolower($department);
                    if(in_array($department,$departmentes))
                    {
                        if(!empty($password))
                        {
                            $password   = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
                            if (strlen($password) >= 6)
                            {
                                $password = $db->encPassword($password);
                            }
                            else
                            {
                                $error = "password Must be Grater Than 6 chars !";
                            }

                        }
                        else
                        {
                            $password = $row[0]['password'];
                        }

                        $sql = "UPDATE employees SET `name`='$name',`email`='$email',`department`='$department',
                            `password`='$password' WHERE `id`='$id' ";
                        $success = $db->update($sql);


                    }
                    else
                    {
                        $error = "This Department Not Found ";
                    }
                }
                else
                {
                    $error = "Please Type Valid Email";
                }
            }
            else
            {
                $error = "name Must be Grater Than 3 chars !";
            }
        }
    }

    ?>


    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-primary">  Edit Employee </h2>
            </div>


            <div class="col-sm-12">
                <?php if($error !=''): ?>
                    <h2 class="p-2 col text-center mt-5  alert alert-danger"> <?php echo $error; ?>  </h2>
                <?php endif; ?>

                <?php if($success !=''): ?>
                    <h2 class="p-2 col text-center mt-5  alert alert-success"> <?php echo $success; ?>  </h2>
                <?php endif; ?>
            </div>
                <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <input type="text" name="name" value="<?=$row[0]['name'];?> "><br>
                    <input type="text" name="email" value="<?=$row[0]['email'];?> "><br>
                    <input type="text" name="department" value="<?=$row[0]['department'];?> ">
                    <input type="password" name="password" value="<?=$row[0]['password'];?> ">
                    <input type="submit" name="submit">
                </form>
            </div>


<?php else: ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Not Found </h3>
            </div>
        </div>
    </div>


<?php  endif;  ?>

<?php include('footer.php'); ?>
