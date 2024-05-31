 <?php

            $query = "SELECT * FROM comments";

            $select_query = mysqli_query($connection, $query);

            ?>

            <div class="card-body mt-5">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In response to</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
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
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];
                        ?>
                            <tr>
                                <td><?php echo $comment_id; ?></td>
                                <td><?php echo $comment_author; ?></td>
                                <td><?php echo $comment_content ?></td>
                                <td><?php echo $comment_email ?></td>
                                <td><?php echo $comment_status ?></td>
                                <td><?php echo $comment_date ?></td>
                                <?php 
                                echo " <td> <a href='post.php?edit={$post_id}'>Approve</a></td>";
                                echo "<td> <a href='post.php?delete={$post_id}'>Unapprove</a></td>";
                                echo " <td> <a href='post.php?edit={$post_id}'>Edit</a></td>";
                                echo "<td> <a href='post.php?delete={$post_id}'>Delete</a></td>";
                                ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>