<?php include "db.php" ?>
<?php 
        if (isset($_POST['submit'])) {
            $search = $_POST['search'];

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $search_query = mysqli_query($connection, $query);

            if(!$search_query){
                echo "<h1>NO RESULT</h1>";
            }else {
                while($data = mysqli_fetch_assoc($search_query)){
                    $post_title = $data['post_title'];
                    $post_author = $data['post_author'];
                    $post_date = $data['post_date'];
                    $post_tags = $data['post_tags'];
                    $post_image = $data['post_image'];
                    $post_content = $data['post_content'];
?>
                             <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted"><?php echo $post_date ?></div>
                                    <h2 class="card-title h4"><?php echo $post_title ?></h2>
                                    <p class="card-text"><?php echo $post_content ?></p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                            <?php } ?>
<?php
            }

        }
?>