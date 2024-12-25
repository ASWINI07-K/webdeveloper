<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Fetch the existing data for the skillset entry
if (isset($_GET['id'])) {
    $sid = $_GET['id'];
    $result = pg_query($conn, "SELECT * FROM mst_skillsets WHERE sid = $sid");
    $skillset = pg_fetch_assoc($result);
}

// Handle form submission for editing skillset entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['skillset_edit_submit'])) {
    $sid = $_POST['sid'];
    $skillset_name = $_POST['skillset'];
    $remarks = $_POST['remarks'];

    // Server-side validation
    $errors = [];
    if (empty($skillset_name)) {
        $errors[] = "Skillset is required.";
    } else {
        // Check for unique skillset
        $result = pg_query($conn, "SELECT * FROM mst_skillsets WHERE skillset = '$skillset_name' AND sid != $sid");
        if (pg_num_rows($result) > 0) {
            $errors[] = "Skillset already exists.";
        }
    }

    if (empty($errors)) {
        // Update data if no errors
        $query = "UPDATE mst_skillsets SET skillset = '$skillset_name', remarks = '$remarks' WHERE sid = $sid";
        pg_query($conn, $query);
        header('Location: skillset_form.php');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Skillset Entry</title>
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
        .errors {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Skillset Entry</h1>
        <?php if (!empty($errors)) { ?>
            <div class="errors">
                <?php foreach ($errors as $error) {
                    echo "<p><?php echo $error; ?></p>";
                } ?>
            </div>
        <?php } ?>
        <form method="POST">
            <input type="hidden" name="sid" value="<?php echo $skillset['sid']; ?>">

            <label for="skillset">Skillset:</label>
            <input type="text" name="skillset" value="<?php echo $skillset['skillset']; ?>" required>

            <label for="remarks">Remarks:</label>
            <textarea name="remarks"><?php echo $skillset['remarks']; ?></textarea>

            <button type="submit" name="skillset_edit_submit">Update</button>
        </form>
    </div>
</body>
</html>
