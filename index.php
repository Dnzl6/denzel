<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration</title>
  <link rel="stylesheet" href="style.css"> 
</head>
<body>
<main>
    <h1>Registration form</h1>
    <form method="post">
        <div>
            <label for="fName">Full Name</label>
            <input type="text" name="fName" id="fName" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="age">Age</label>
            <input type="number" name="age">
        </div>
        <div>
            <label for="course">Course</label>
            <select name="course">
                <option value="NET">NET</option>
                <option value="SOD">SOD</option>
                <option value="ELS">ELS</option>
            </select>
        </div>
        <div>
    <button name="submit">Submit</button>
    <button type="button" onclick="showUpdateForm()">Update User</button>
    <button onclick="window.location.href='read.php'" class="button">delete user</button>
</div>

    </form>
    <form method="post" action="update.php" id="updateForm" style="display: none;">
        <input type="text" name="userID" placeholder="User ID">
        <button type="submit">Update User</button>
    </form>

    <?php 
    include 'db.php';

    if (isset($_POST['userID'])) {
        $userID = $_POST['userID'];
        
        $query = "SELECT * FROM users WHERE id = '$userID'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
    ?>
            <h2>Current Information of User</h2>
            <p>User ID: <?php echo $user['id']; ?></p>
            <p>Full Name: <?php echo $user['fullName']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Age: <?php echo $user['age']; ?></p>
            <p>Course: <?php echo $user['course']; ?></p>

            <h2>Update User Information</h2>
            <form method="post" action="update.php">
                <input type="hidden" name="userID" value="<?php echo $user['id']; ?>">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo $user['fullName']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?php echo $user['age']; ?>">
                <label for="course">Course:</label>
                <select id="course" name="course">
                    <option value="NET" <?php if ($user['course'] == 'NET') echo 'selected'; ?>>NET</option>
                    <option value="SOD" <?php if ($user['course'] == 'SOD') echo 'selected'; ?>>SOD</option>
                    <option value="ELS" <?php if ($user['course'] == 'ELS') echo 'selected'; ?>>ELS</option>
                </select>
                <button type="submit">Update User</button>
            </form>
    <?php
        } else {
            echo "User not found in the database.";
        }
    }
    ?>
</main>
<script>
    function showUpdateForm() {
        document.getElementById('updateForm').style.display = 'block';
    }
</script>
</body>
</html>
