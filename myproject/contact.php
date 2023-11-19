<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'web';

$conn = mysqli_connect($host, $user, $pass, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO project(name, email, subject, message) VALUES ('$name','$email','$subject','$message')";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM project";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
       

        .topic {
            font-size: 2em;
            color: #ccc;
            margin-bottom: 450px;
           text-align: right;
           

        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .data {
            font-weight: bold;
            margin-top: 20px;
        }

        p {
            text-align: center;
        }

        .no-data {
            font-style: italic;
        }
    </style>
</head>
<body>
    
        <div class="topic">Contact Us</div>
   
    <form action="contact.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        
        <label for="message">Message:</label>
        <input type="textarea" id="message" name="message" required>
        <input type="submit" name="submit" value="Send Data">
    </form>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo '<p class="data">Student Data:</p>';
        echo '<table border="1">';
        echo '<tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['subject'] . '</td>';
            echo '<td>' . $row['message'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No data available.</p>';
    }
    ?>
</body>
</html>