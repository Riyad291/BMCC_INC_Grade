<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        
        header {
            background-color: #3446e6;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        
        nav {
            background-color: #8bcce4;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        
        nav ul li {
            display: inline;
            margin: 0 10px;
        }
        
        .container {
            margin: 20px auto;
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .progress {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 6px 0;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <header>
        <img src="Images/start-here-cuny-5.png" alt="Start Here Go Anywhere">
        <h1>Student Portal</h1>
    </header>
    <nav>
        <ul>
            <li><a href="file:///Users/yeasinarafatriyad/Downloads/BMCC_INC_Grade/index.html">Home</a></li>
        
            <li><a href="#">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Assignments</h2>
        <div class="dropdown">
            <button class="dropbtn">Select Assignment</button>
            <div class="dropdown-content">
                <!-- Placeholder for dynamic data -->
                <a href="#">Assignment 1</a>
                <a href="#">Assignment 2</a>
                <a href="#">Assignment 3</a>
                <a href="#">Assignment 4</a>
                <a href="#">Assignment 5</a>
            </div>
        </div>
        <div class="progress">
            <h2>Student Progress Report</h2>
            <!-- Placeholder for dynamic data -->
            <p>Professor: [Professor Name]</p>
            <p>Course: [Course Name]</p>
            <p>Due Date: [Due Date]</p>
            <p>Overall Progress: 75%</p>
            <p>Assignment 1: 80%</p>
            <p>Assignment 2: 70%</p>
            <p>Assignment 3: 90%</p>
            <p>Assignment 4: 60%</p>
            <p>Assignment 5: 80%</p>
        </div>
    </div>
</body>
</html>
<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "incgrade"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to authenticate user
function authenticateUser($conn, $username, $password) {
    
    $username = $conn->real_escape_string($username);

    // Fetch user data from the database
    $sql = "SELECT Username, PasswordHash FROM Students WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
        $row = $result->fetch_assoc();
        $hashedPassword = $row["PasswordHash"];
        
        
        if (password_verify($password, $hashedPassword)) {
          
            return true;
        } else {
           
            return false;
        }
    } else {
       
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    if (authenticateUser($conn, $username, $password)) {
        
        echo "Authentication successful. Welcome, $username!";
    } else {
        // Authentication failed
        echo "Authentication failed. Invalid username or password.";
    }
}

// Close connection
$conn->close();
?>
