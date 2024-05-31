
<?php include "includes/adminheader.php" ?>

<div id="layoutSidenav">
    <?php include "includes/sidenab.php" ?>
    <div id="layoutSidenav_content">

        <div class="container px-4">
            <h1 class="mt-4">posts</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Posts</li>
            </ol>

            <div class="container">
                <div class="row">
                    <!-- --------------------------------------------Add posts starts------------------------------------------------------ -->

                    <?php

                    if (isset($_POST['submit'])) {

                        $post_title = $_POST['post_title'];
                        $post_content = $_POST['post_content'];
                        $post_author = $_POST['post_author'];
                        $post_status = $_POST['post_status'];
                        $post_image = $_FILES['image']['name'];
                        $post_image_temp = $_FILES['image']['temp_name'];
                        $post_date = date('d-m-y');
                        $post_tags = $_POST['post_tags'];
                        $total_comment = 4;


                        if ($post_title == "" || empty($post_title)) {
                            echo "This field should not be empty!";
                        } else {
                            $query = "INSERT INTO posts(`post_title`)";
                            $query .= "VALUES ('$post_title')";

                            $result = mysqli_query($connection, $query);

                            if (!$result) {
                                die('Error' . mysqli_error($result));
                            }
                        }

                        move_uploaded_file($post_image_temp, "../images/$post_image");
                    }

                    ?>

                    <div class="col-md-6">
                        <form action="post.php" method="post" enctype="multipart/form-data">
                            <h4 class="mt-4 mb-3 text-center">Add Posts</h4>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Title</label>
                                <input type="text" class="form-control" id="forminput" name="post_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Content</label>
                                <textarea type="text" class="form-control" id="forminput" name="post_content" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Author</label>
                                <input type="text" class="form-control" id="forminput" name="post_author" required>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Status</label>
                                <input type="text" class="form-control" id="forminput" name="post_status" required>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Author</label>
                                <input type="file" class="form-control" id="forminput" name="post_image" required>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Date</label>
                                <input type="date" class="form-control" id="forminput" name="post_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="forminput" class="form-label">Post Tags</label>
                                <input type="text" class="form-control" id="forminput" name="post_tags" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Publish Post</button>
                        </form>
                    </div>


                    <!-- --------------------------------------------Add posts ends------------------------------------------------------ -->

                    <!-- --------------------------------------------Edit posts starts------------------------------------------------------ -->

                    <?php /* if (isset($_POST['update'])) {
                        $edited_name = $_POST['edit_name'];
                    } */ ?>

                    <div class="col-md-6">
                        <form action="post.php">
                            <?php

                            if (isset($_GET['edit'])) {
                                $post_id = $_GET['edit'];

                                $query = "SELECT * FROM `posts` WHERE `post_id`=$post_id";

                                $edit_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($edit_query);

                                $edit_title = $row['post_title'];
                                $edit_content = $row['post_content'];
                                $edit_author = $row['post_author'];
                                $edit_date = $row['post_date'];
                                $edit_tags = $row['post_tags'];


                            ?>
                                <h4 class="mt-4 mb-3 text-center">Edit posts</h4>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Post Name</label>
                                    <input type="text" class="form-control" value="<?php echo $edit_title; ?>" id="forminput" name="edit_name">
                                </div>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Post Content</label>
                                    <input type="text" class="form-control" value="<?php echo $edit_content; ?>" id="forminput" name="edit_name">
                                </div>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Post Author</label>
                                    <input type="text" class="form-control" value="<?php echo $edit_author; ?>" id="forminput" name="edit_name">
                                </div>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Post Date</label>
                                    <input type="date" class="form-control" value="<?php echo $edit_date; ?>" id="forminput" name="edit_name">
                                </div>
                                <div class="mb-3">
                                    <label for="forminput" class="form-label">Post Tags</label>
                                    <input type="text" class="form-control" value="<?php echo $edit_tags; ?>" id="forminput" name="edit_name">
                                </div>
                                <button type="submit" class="btn btn-warning" name="update">Edit</button>
                            <?php } ?>
                        </form>
                    </div>

                    <!-- --------------------------------------------Edit posts ends------------------------------------------------------ -->
                </div>
            </div>



            <!-- --------------------------------------------Table starts------------------------------------------------------ -->

            <?php

            $query = "SELECT * FROM posts";

            $select_query = mysqli_query($connection, $query);

            ?>

            <div class="card-body mt-5">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Tags</th>
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
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_content = $row['post_content'];
                            $post_image = $row['post_image'];
                            $post_category = $row['post_cat_id'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_tags = $row['post_tags'];
                        ?>
                            <tr>
                                <td><?php echo $post_id; ?></td>
                                <td><?php echo $post_title; ?></td>
                                <td><?php echo $post_content ?></td>
                                <td><?php echo $post_image ?></td>
                                <td><?php echo $post_category ?></td>
                                <td><?php echo $post_author ?></td>
                                <td><?php echo $post_date ?></td>
                                <td><?php echo $post_tags ?></td>
                                <?php echo " <td> <a href='post.php?edit={$post_id}'>Edit</a></td>";
                                echo "<td> <a href='post.php?delete={$post_id}'>Delete</a></td>";
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
            $del_post_id = $_GET['delete'];

            $query = "DELETE FROM `posts` WHERE `post_id`={$del_post_id}";

            $delete_query = mysqli_query($connection, $query);

            header("Location:post.php");
        }

        ?>



        <?php include "includes/adminfooter.php" ?>

    </div>

</div>


</html>