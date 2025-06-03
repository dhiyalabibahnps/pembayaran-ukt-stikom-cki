<?php
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_array($query);

    if ($data) {
        $_SESSION['admin'] = $data['username'];
        header("Location: admin.php");
    } else {
        echo "<script>alert('Login admin gagal!');</script>";
    }
}
?>

<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>UI Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet" />
    <style>
        /* Hide default input number spinner for password toggle */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex items-center justify-center p-4">
    <div
        class="max-w-6xl w-full bg-white flex flex-col md:flex-row items-center p-8">
        <div class="flex justify-center md:w-1/2 mb-8 md:mb-0 md:h-full">
            <img
                alt="STIKOM Cipta Karya Informatika logo shield with blue, red, yellow, and black elements and text below"
                class="w-[300px] h-auto"
                height="300"
                src="logo_login.png"
                width="300" />
        </div>
        <form method="post" class="md:w-1/2 bg-white rounded-lg p-8 shadow-lg max-w-md w-full">
            <h2 class="text-xl font-semibold mb-6">Login Admin</h2>
            <label class="block text-xs font-semibold mb-1" for="username">
                Username
            </label>
            <input
                class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-xs focus:outline-none focus:ring-1 focus:ring-indigo-600"
                name="username"
                type="text"
                placeholder="Username"
                required />
            <label class="block text-xs font-semibold mb-1" for="password">
                Password
            </label>
            <div class="relative mb-2">
                <input
                    class="w-full border border-gray-300 rounded px-3 py-2 pr-10 text-xs focus:outline-none focus:ring-1 focus:ring-indigo-600"
                    name="password"
                    type="password"
                    placeholder="Password"
                    required />
                <button
                    aria-label="Toggle password visibility"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 text-xs"
                    onclick="togglePassword()"
                    type="button">
                    <i class="fas fa-eye-slash" id="eyeIcon"> </i>
                </button>
            </div>
            <div class="flex justify-between items-center mb-4 text-xs">
                <label class="flex items-center space-x-1">
                    <input checked="" class="w-3 h-3" type="checkbox" />
                    <span> Remember me </span>
                </label>
                <a class="text-gray-500 hover:text-indigo-600" href="#">
                    Forgot password?
                </a>
            </div>
            <div class="flex flex-row gap-2 mb-4">
                <button
                    class="bg-indigo-900 text-white text-xs rounded px-6 py-2 hover:bg-indigo-800 transition w-full"
                    type="submit"
                    name="login">
                    Login
                </button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>

</html>