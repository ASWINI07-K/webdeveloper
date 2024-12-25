<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Delete manpower entry
if (isset($_GET['id'])) {
    $manid = $_GET['id'];
    pg_query($conn, "DELETE FROM manpower WHERE manid = $manid");
    header('Location: manpower_form.php');
}
?>
