<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Handle form submission for skillset entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skillset_submit'])) {
    $skillset = $_POST['skillset'];
    $remarks = $_POST['remarks'];

    // Server-side validation
    $errors = [];
    if (empty($skillset)) {
        $errors[] = "Skillset is required.";
    } else {
        // Check for unique skillset
        $result = pg_query($conn, "SELECT * FROM mst_skillsets WHERE skillset = '$skillset'");
        if (pg_num_rows($result) > 0) {
            $errors[] = "Skillset already exists.";
        }
    }

    if (empty($errors)) {
        // Insert data if no errors
        $query = "INSERT INTO mst_skillsets (skillset, remarks) VALUES ('$skillset', '$remarks')";
        pg_query($conn, $query);
    }
}

// Fetch existing skillset entries
$skillset_entries = pg_query($conn, "SELECT * FROM mst_skillsets");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Skillset Entry Form</title>
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
        input[type="text"], textarea, button {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Skillset Entry Form</h1>
        <?php if (!empty($errors)) { ?>
            <div class="errors">
                <?php foreach ($errors as $error) {
                    echo "<p>$error</p>";
                } ?>
            </div>
        <?php } ?>
        <form method="POST">
            <label for="skillset">Skillset:</label>
            <input type="text" name="skillset" >

            <label for="remarks">Remarks:</label>
            <textarea name="remarks"></textarea>

            <button type="submit" name="skillset_submit">Submit</button>
        </form>

        <h2>Existing Skillset Entries</h2>
        <table>
            <tr>
                <th>Skillset</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = pg_fetch_assoc($skillset_entries)) { ?>
                <tr>
                    <td><?php echo $row['skillset']; ?></td>
                    <td><?php echo $row['remarks']; ?></td>
                    <td>
                        <a href="edit_skillset.php?id=<?php echo $row['sid']; ?>">Edit</a>
                        <a href="delete_skillset.php?id=<?php echo $row['sid']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
