<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Handle form submission for manpower entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['manpower_submit'])) {
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $skill_code = $_POST['skill_code'];
    $address = $_POST['address'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $remarks = $_POST['remarks'];

    // Server-side validations
    $errors = [];

    

    // Validate name
    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $errors[] = "Name must contain only alphabetic characters and spaces.";
    }

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
        // Insert data if no errors
        $query = "INSERT INTO manpower (name, date_of_birth, skill_code, address, mobileno, email, remarks) VALUES ('$name', '$date_of_birth', $skill_code, '$address', '$mobileno', '$email', '$remarks')";
        pg_query($conn, $query);
    }
}

// Fetch skillsets for the dropdown
$skillsets = pg_query($conn, "SELECT * FROM mst_skillsets");

// Fetch existing manpower entries
$manpower_entries = pg_query($conn, "SELECT m.*, s.skillset FROM manpower m JOIN mst_skillsets s ON m.skill_code = s.sid");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manpower Entry Form</title>
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
        h1, h2 {
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .errors {
            color: red;
            margin-top: 20px;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .error {
    color: red;
    font-size: 12px;
    margin-top: 5px;
}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function editManpower(manid) {
            $.ajax({
                url: 'edit_manpower_ajax.php',
                method: 'GET',
                data: { id: manid },
                success: function(response) {
                    $('#modal-content').html(response);
                    $('#myModal').show();
                }
            });
        }

        // Close the modal when the user clicks on <span> (x)
        $(document).on('click', '.close', function() {
            $('#myModal').hide();
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Manpower Entry Form</h1>
        <?php if (!empty($errors)) { ?>
    <?php foreach ($errors as $field => $error) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
<?php } ?>
        <form method="POST" >
            
            <label for="name">Name:</label>

            <input type="text" name="name" pattern="[a-zA-Z\s]+" title="Name must contain only letters and spaces" required>
           

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" required>

            <label for="skill_code">Skill Code:</label>
            <select name="skill_code" required>
                <?php while ($row = pg_fetch_assoc($skillsets)) { ?>
                    <option value="<?php echo $row['sid']; ?>"><?php echo $row['skillset']; ?></option>
                <?php } ?>
            </select>

            <label for="address">Address:</label>
            <textarea name="address" required></textarea>

            <label for="mobileno">Mobile No:</label>
            <input type="text" name="mobileno" pattern="[5-9][0-9]{9}" title="Mobile number must start with 5-9 and be 10 digits long" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="remarks">Remarks:</label>
            <textarea name="remarks"></textarea>

            <button type="submit" name="manpower_submit">Submit</button>
        </form>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content" id="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>

        <h2>Existing Manpower Entries</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Skillset</th>
                <th>Address</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = pg_fetch_assoc($manpower_entries)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['skillset']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['mobileno']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['remarks']; ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="editManpower(<?php echo $row['manid']; ?>)">Edit</a>
                        <a href="delete_manpower.php?id=<?php echo $row['manid']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
