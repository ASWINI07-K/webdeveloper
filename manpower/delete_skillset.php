<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Delete skillset entry
if (isset($_GET['id'])) {
    $sid = $_GET['id'];
    pg_query($conn, "DELETE FROM mst_skillsets WHERE sid = $sid");
    header('Location: skillset_form.php');
}
?>
