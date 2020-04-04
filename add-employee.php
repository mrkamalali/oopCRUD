<?php include('header.php');
include('nav.php');
//include('Database.php');

$departments = array('it', 'cs');
$error = '';
$success = '';


if (isset($_POST['submit'])) {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if (empty($name) || empty($department) || empty($email) || empty($password)) {
        $error = "Please Fill All Fildes..";
    } else {

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $department = strtolower($department);
            if (in_array($department, $departments))  // To Make Sure That the Department Came Form $Departments Array...
            {
                if (strlen($password) >= 6) {

//                    Insert Data
//                    $db = new Database();
                    $hashedPassword = $db->passwordHash($password);
                    $sql = "INSERT INTO employees(`name`, `email`, `department`,`password`)
                    VALUES ('$name','$email' , '$department' ,'$hashedPassword')";
                    $success = $db->insert($sql);

                } else {
                    $error = "Password Less Than 6 Letters";
                }

            } else {
                $error = "We Have No Any Department With This Name";
            }

        } else {
            $error = "Please Enter Valid Email";
        }

    }
}


?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center font-italic">Add New One </h2>
            </div>
            <div class="col-sm-6 offset-3">

                <?php if ($error != ''): ?>
                    <h2 class="p-3 col text-center mt-5 text-blue alert alert-danger"> <?php echo $error; ?>  </h2>
                <?php endif; ?>
                <?php if ($success != ''): ?>
                    <h2 class="p-3 col text-center mt-5 text-blue alert alert-success"> <?php echo $success; ?>  </h2>
                <?php endif; ?>

            </div>
            <div class="col-md-8 offset-2">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label class="btn-outline-success" for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php  ?>" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label class="btn-outline-success" for="department">Department</label>
                        <input type="text" name="department" class="form-control" id="department"
                               placeholder="Enter department">
                    </div>

                    <div class="form-group">
                        <label class="btn-outline-success" for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>


                    <div class="form-group">
                        <label class="btn-outline-success" for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php');

