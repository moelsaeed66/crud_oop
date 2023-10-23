<?php global $db;
include('header.php');?>
<?php
$errors="";
$success="";
$departments=['is','cs','it'];
if(isset($_POST['submit'])){
    $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $department=filter_var($_POST['department'],FILTER_SANITIZE_STRING);
    $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    if(empty($name) or empty($email) or empty($department) or empty($password)){
        $errors="please fill all fields";
    }else{
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $department=strtolower($department);
            if(in_array($department,$departments)){
                if(strlen($password )>6){

                    $sql="INSERT INTO `employees`(`name`, `email`, `department`, `password`) 
                        VALUES ('$name','$email','$department','$password')";

                    $db->insertEmployee($sql);
                    $success="data added successfully";
                }else{
                    $errors="password must be more than 6 chars";
                }
            }else{
                $errors="department not found";
            }
        }else{
            $errors="this email not valid";
        }
    }


}

?>
<div class="container">
    <h1>Add Employee</h1>
    <div class="col-sm-12">
        <?php if (!empty($errors)):?>

        <h2 class="p-2 col text-center mt-5  alert alert-danger"><?php echo $errors;?>  </h2>
        <?php endif;?>

        <?php if (!empty($success)):?>
            <h2 class="p-2 col text-center mt-5  alert alert-danger"><?php echo $success;?>  </h2>
        <?php endif;?>


    </div>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <input type="text" name="name" placeholder="your name">
        <input type="text" name="email" placeholder="your email">
        <input type="text" name="department" placeholder="your department">
        <input type="password" name="password" placeholder="your password">
        <input type="submit" name="submit">
    </form>
</div>



<?php include('footer.php');?>
