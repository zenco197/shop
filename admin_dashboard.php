<?php
// File paths
$usersFile = "users.txt";
$ordersFile = "orders.txt";

// Ensure files exist
if (!file_exists($usersFile)) file_put_contents($usersFile, "admin@example.com,admin123,admin\nuser@example.com,user123,user\njhames.martin@example.com,Jhames123,user\n");
if (!file_exists($ordersFile)) file_put_contents($ordersFile, "Order Details:\nName: Jhames BOT\nEmail: jhameseditingph@gmail.com\nAddress: Jhajsisu\nPayment Method: COD\nItems:\n- Premium Ballpens (6x) - ₱150.00\nTotal: ₱150\n-------------------------");

// Read users and orders
$usersData = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$ordersData = file_exists($ordersFile) ? file_get_contents($ordersFile) : "No orders available.";

// Handle User Deletion
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($usersData[$index]);
    file_put_contents($usersFile, implode("\n", $usersData));
    header("Location: admin_dashboard.php");
    exit;
}

// Handle User Addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newEmail"], $_POST["newPassword"], $_POST["newRole"])) {
    $newUser = $_POST["newEmail"] . "," . $_POST["newPassword"] . "," . $_POST["newRole"];
    file_put_contents($usersFile, implode("\n", $usersData) . "\n" . $newUser);
    header("Location: admin_dashboard.php");
    exit;
}

// Handle User Updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editedUsers"])) {
    file_put_contents($usersFile, $_POST["editedUsers"]);
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #28a745;
            --danger-color: #dc3545;
            --dark-bg: #343a40;
            --light-bg: #f8f9fa;
            --text-dark: #333;
            --text-light: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: var(--light-bg);
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: var(--text-light);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--light-bg);
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background: var(--primary-color);
            color: var(--text-light);
        }

        table tr:nth-child(even) {
            background: #f2f2f2;
        }

        table tr:hover {
            background: #e9ecef;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
            transition: 0.3s;
        }
       .btn-product{
        padding: 8px 7px;
        font-size: 14px;
        border-radius: 5px;
        background: var(--primary-color); 
        color: var(--text-light);
       }
       .btn-product-hoover{
        background: blue;
       }
        .edit { background: var(--secondary-color); color: var(--text-light); }
        .delete { background: var(--danger-color); color: var(--text-light); }
        .save { background: var(--primary-color); color: var(--text-light); }
        .logout { background: var(--dark-bg); color: var(--text-light); }
        .btn:hover { opacity: 0.8; }

        .orders-box {
            background: var(--light-bg);
            padding: 10px;
            border-radius: 5px;
            height: 200px;
            overflow-y: auto;
            white-space: pre-line;
            border: 1px solid #ddd;
        }

        input[type="text"], input[type="password"], select {
            padding: 8px;
            width: 100%;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .form-container input, .form-container select {
            flex: 1;
            min-width: 200px;
        }

        .form-container button {
            flex: none;
        }

        @media (max-width: 768px) {
            table, th, td {
                font-size: 12px;
            }
            .btn {
                padding: 6px 10px;
                font-size: 12px;
            }
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <p style="text-align: center;">Welcome, Admin!</p>

        <h3>Manage Users</h3>
        <form method="POST">
            <table>
                <tr>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($usersData as $index => $line): 
                    list($email, $password, $role) = explode(",", $line);
                ?>
                <tr>
                    <td><input type="text" name="users[<?= $index ?>][email]" value="<?= htmlspecialchars($email) ?>" required></td>
                    <td><input type="password" name="users[<?= $index ?>][password]" value="<?= htmlspecialchars($password) ?>" required></td>
                    <td>
                        <select name="users[<?= $index ?>][role]">
                            <option value="admin" <?= ($role == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= ($role == 'user') ? 'selected' : '' ?>>User</option>
                        </select>
                    </td>
                    <td>
                        <a href="?delete=<?= $index ?>" class="btn delete" onclick="return confirm('Delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit" class="btn save">Save Changes</button>
        </form>
         <button type="button" class="btn-product" onclick="window.location.href='new_product.html'">Add New Product</button>
        <h3>Add New User</h3>
        <form method="POST" class="form-container">
            <input type="text" name="newEmail" placeholder="Enter email" required>
            <input type="password" name="newPassword" placeholder="Enter password" required>
            <select name="newRole">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit" class="btn edit">Add User</button>
        </form>

        <h3>Orders (Read-Only)</h3>
       <div class="orders-box"><?= nl2br(htmlspecialchars($ordersData)) ?></div>
        
        <a href="index.html" class="btn logout">Logout</a>
    </div>
</body>
</html>