<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Fetch the existing data for the manpower entry
if (isset($_GET['id'])) {
    $manid = $_GET['id'];
    $result = pg_query($conn, "SELECT * FROM manpower WHERE manid = $manid");
    $manpower = pg_fetch_assoc($result);
}

// Handle form submission for editing manpower entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['manpower_edit_submit'])) {
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

// Fetch skillsets for the dropdown
$skillsets = pg_query($conn, "SELECT * FROM mst_skillsets");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Manpower Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], input[type="email"], textarea, select, button {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover {
            background-color: #218838;
        }
        .errors {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Manpower Entry</h1>
        <?php if (!empty($errors)) { ?>
            <div class="errors">
                <?php foreach ($errors as $error) {
                    echo "<p><?php echo $error; ?></p>";
                } ?>
            </div>
        <?php } ?>
        <form method="POST">
            <input type="hidden" name="manid" value="<?php echo $manpower['manid']; ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $manpower['name']; ?>" required>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" value="<?php echo $manpower['date_of_birth']; ?>" required>

            <label for="skill_code">Skill Code:</label>
            <select name="skill_code" required>
                <?php while ($row = pg_fetch_assoc($skillsets)) { ?>
                    <option value="<?php echo $row['sid']; ?>" <?php if ($row['sid'] == $manpower['skill_code']) echo 'selected'; ?>><?php echo $row['skillset']; ?></option>
                <?php } ?>
            </select>

            <label for="address">Address:</label>
            <textarea name="address" required><?php echo $manpower['address']; ?></textarea>

            <label for="mobileno">Mobile No:</label>
            <input type="text" name="mobileno" value="<?php echo $manpower['mobileno']; ?>" pattern="[5-9][0-9]{9}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $manpower['email']; ?>" required>

            <label for="remarks">Remarks:</label>
            <textarea name="remarks"><?php echo $manpower['remarks']; ?></textarea>

            <button type="submit" name="manpower_edit_submit">Update</button>
        </form>
    </div>
</body>
</html>
