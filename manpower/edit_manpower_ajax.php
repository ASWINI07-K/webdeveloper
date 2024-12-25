<?php
// Connect to the database
$conn = pg_connect("host=localhost dbname=manpower user=postgres password=aswini");

// Fetch the existing data for the manpower entry
if (isset($_GET['id'])) {
    $manid = $_GET['id'];
    $result = pg_query($conn, "SELECT * FROM manpower WHERE manid = $manid");
    $manpower = pg_fetch_assoc($result);

    // Fetch skillsets for the dropdown
    $skillsets = pg_query($conn, "SELECT * FROM mst_skillsets");
?>

<form method="POST" action="update_manpower.php">
    <input type="hidden" name="manid" value="<?php echo $manpower['manid']; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $manpower['name']; ?>" required>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" name="date_of_birth" value="<?php echo $manpower['date_of_birth']; ?>" required>

    <label for="skill_code">Skill Code:</label>
    <select name="skill_code" required>
        <?php while ($row = pg_fetch_assoc($skillsets)) { ?>
            <option value="<?php echo $row['sid']; ?>" <?php if ($row['sid'] == $manpower['skill_code']) echo 'selected'; ?>>
                <?php echo $row['skillset']; ?>
            </option>
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

    <button type="submit" name="manpower_update_submit">Update</button>
</form>

<?php
}
?>
