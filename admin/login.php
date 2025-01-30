<?php
session_start();

$users = json_decode(file_get_contents('../config/users.json'), true);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4 max-w-md">
        <div class="bg-white rounded-xl p-8 shadow-lg">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-[#6879EF] mb-2">Welcome Back</h2>
                <p class="text-gray-600">Sign in to your admin account</p>
            </div>
            
            <?php if(isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Username</label>
                    <input type="text" name="username" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF] focus:border-transparent"
                        placeholder="Enter your username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-[#6879EF] focus:border-transparent"
                        placeholder="Enter your password">
                </div>
                <button type="submit" 
                    class="w-full bg-[#6879EF] text-white py-3 rounded-lg hover:bg-[#5a6ad8] transition-all">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>