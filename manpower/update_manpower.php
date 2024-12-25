<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Handle form submission for manpower update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['manpower_update_submit'])) {
    $manid = $_POST['manid'];
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $skill_code = $_POST['skill_code'];
    $address = $_POST['address'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $remarks = $_POST['remarks'];

    // Server-side validations
    $errors = [];

    // Validate age
    $dob = new DateTime($date_of_birth);
    $now = new DateTime();
    $age = $now->diff($dob)->y;
    if ($age < 25) {
        $errors[] = "Age must be 25 years or older.";
    }

    // Validate mobile number
    if (!preg_match('/^[5-9][0-9]{9}$/', $mobileno)) {
        $errors[] = "Mobile number must start with 5-9 and be 10 digits long.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($errors)) {
        // Update data if no errors
        $query = "UPDATE manpower SET name = '$name', date_of_birth = '$date_of_birth', skill_code = $skill_code, address = '$address', mobileno = '$mobileno', email = '$email', remarks = '$remarks' WHERE manid = $manid";
        pg_query($conn, $query);
        header('Location: manpower_form.php');
    }
}
?>
