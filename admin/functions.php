<?php

function insert_cats() {
	global $connection;
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
}





?>