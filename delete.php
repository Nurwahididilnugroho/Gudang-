<?php
include 'db.php';

$id = $_GET['id'];

$db->exec("DELETE FROM items WHERE id = $id");

header("Location: index.php");
?>
