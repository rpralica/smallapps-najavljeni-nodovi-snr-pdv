<?php
require "../settings/connection.php";
$element = mysqli_real_escape_string($db, $_POST['element']);
$lokacija = mysqli_real_escape_string($db, $_POST['lokacija']);
$pocetak = mysqli_real_escape_string($db, $_POST['pocetak']);
$trajanje = mysqli_real_escape_string($db, $_POST['trajanje']);
$komentar = mysqli_real_escape_string($db, $_POST['komentar']);
$id = $_POST['id'];

if (empty($element)) {
    // Redirect back to edit.php with error message
    header("Location: ../components/edit.php?id=$id&error=empty_element");
    exit(); // Stop further execution
}
if (empty($lokacija)) {
    // Redirect back to edit.php with error message
    header("Location: ../components/edit.php?id=$id&error=empty_lokacija");
    exit(); // Stop further execution
}
// Convert string datetime to timestamp for comparison
$pocetak_timestamp = strtotime($pocetak);
$trajanje_timestamp = strtotime($trajanje);
// Check if $trajanje < $pocetak
if ($trajanje_timestamp < $pocetak_timestamp) {
    // Redirect back to edit.php with error message
    header("Location: ../components/edit.php?id=$id&error=invalid_date_range");
    exit(); // Stop further execution
}
$sql = "UPDATE najave SET element='$element',lokacija='$lokacija',pocetak='$pocetak', trajanje='$trajanje',komentar='$komentar' WHERE id='$id' ";
$query = mysqli_query($db, $sql);
header("Location:../index.php");
