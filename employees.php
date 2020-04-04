<?php include('header.php');
include('nav.php');
//include('Database.php'); ?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 style="color: orangered; padding-bottom: 8px" class="text-center  font-italic"> Show All
                    Employess</h2>
            </div>

<!--            --><?php //$db = new Database() ?>
            <?php if (count($db->show("employees"))): ?>

                <div class="col-sm-12">
                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($db->show("employees") as $row): ?>
                            <tr>
                                <td><?php echo strtoupper($row['name']); ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo strtoupper($row['department']); ?></td>

                                <!-- Need the internet To Show -->
                                <td>
                                    <a href="edit-employee.php?id=<?php echo $row['id'] ?>" class="text-primary">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                </td>

                                <!-- Need the internet To Show -->
                                <td>
                                    <a href="delete-employee.php?id=<?php echo $row['id'] ?>" class="text-danger">
                                        <i class="fa fa-times fa-2x"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

            <?php else: ?>

                <div class="col-sm-12">
                    <h3 class="alert alert-danger mt-5 text-center"> Not Found Data </h3>
                </div>

            <?php endif; ?>

        </div>
    </div>

<?php include('footer.php');

