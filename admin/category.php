<?php include "../includes/db.php" ?>
<?php include "includes/adminheader.php" ?>

<div id="layoutSidenav">
    <?php include "includes/sidenab.php" ?>
    <div id="layoutSidenav_content">

        <div class="container px-4">
            <h1 class="mt-4">Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>

            <div class="container">
                <div class="row">
                    <!-- --------------------------------------------Add category starts------------------------------------------------------ -->

                    <?php

                    if (isset($_POST['submit'])) {

                        $cat_title = $_POST['cat_name'];

                        if ($cat_title == "" || empty($cat_title)) {
                            echo "This field should not be empty!";
                        } else {
                            $query = "INSERT INTO categories(`cat_name`)";
                            $query .= "VALUES ('$cat_title')";

                            $result = mysqli_query($connection, $query);

                            if (!$result) {
                                die('Error' . mysqli_error($result));
                            }
                        }
                    }

                    ?>

                    <div class="col-md-6">
                        <form action="category.php" method="post">
                            <h4 class="mt-4 mb-3 text-center">Add category</h4>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="forminput" name="cat_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                        </form>
                    </div>


                    <!-- --------------------------------------------Add category ends------------------------------------------------------ -->

                    <!-- --------------------------------------------Edit category starts------------------------------------------------------ -->

                    <?php /* if (isset($_POST['update'])) {
                        $edited_name = $_POST['edit_name'];
                    } */ ?>

                    <div class="col-md-6">
                        <form action="category.php">
                            <?php

                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                $query = "SELECT `cat_name` FROM `categories` WHERE `cat_id`=$cat_id";

                                $edit_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($edit_query);

                                $edit_name = $row['cat_name'];


                            ?>
                                <h4 class="mt-4 mb-3 text-center">Edit category</h4>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" value="<?php echo $edit_name; ?>" id="forminput" name="edit_name">
                                </div>
                                <button type="submit" class="btn btn-warning" name="update">Edit</button>
                            <?php } ?>
                        </form>
                    </div>

                    <!-- --------------------------------------------Edit category ends------------------------------------------------------ -->
                </div>
            </div>



            <!-- --------------------------------------------Table starts------------------------------------------------------ -->

            <?php

            $query = "SELECT * FROM categories";

            $select_query = mysqli_query($connection, $query);

            ?>

            <div class="card-body mt-5">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($select_query)) {
                            $cat_id = $row['cat_id'];
                            $cat_name = $row['cat_name'];
                        ?>
                            <tr>
                                <td><?php echo $cat_id; ?></td>
                                <td><?php echo $cat_name; ?></td>
                                <?php echo " <td> <a href='category.php?edit={$cat_id}'>Edit</a></td>";
                                echo "<td> <a href='category.php?delete={$cat_id}'>Delete</a></td>";
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- --------------------------------------------Table  ends------------------------------------------------------ -->
        </div>
        </main>


        <?php
        if (isset($_GET['delete'])) {
            $del_cat_id = $_GET['delete'];

            $query = "DELETE FROM `categories` WHERE `cat_id`={$del_cat_id}";

            $delete_query = mysqli_query($connection, $query);

            header("Location:category.php");
        }

        ?>



        <?php include "includes/adminfooter.php" ?>

    </div>

</div>


</html>