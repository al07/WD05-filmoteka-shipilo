<?php



function films_all() {

    $query = "SELECT *FROM `films`";
    $films = array();
    $result = mysqli_query($link, $query);

}


?>