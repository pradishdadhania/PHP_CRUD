<?php

session_start();
$name = "";
$location = "";
$update = false;
$id = 0;
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name,location) VALUE('$name','$location') ") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been Delete!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if ($result) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $q="UPDATE data SET name='$name',location='$location' WHERE id=$id";
    $mysqli->query($q) or die($mysqli->error);
    $_SESSION['message'] = "Record has been Update";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
?>