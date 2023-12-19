<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Responsive navbar-->
<?php include "includes/navigation.php" ?>
<!-- Page header with logo and tagline-->
<?php include "includes/pageheader.php" ?>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title">Featured Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                </div>
            </div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <?php
                    $query = "SELECT  * FROM   posts";
                    $query_data = mysqli_query($connection, $query);
                    while ($data = mysqli_fetch_assoc($query_data)) {
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
                </div>
            </div>
            <!-- Pagination-->
            <?php include "includes/pagination.php" ?>
        </div>
        <!-- Side widgets-->
        <?php include "includes/sidebar.php" ?>
    </div>
</div>
<?php include "includes/footer.php" ?>