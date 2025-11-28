<?php
session_start();
require "../config/database.php"; // koneksi sudah dari sini

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil user berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika user ditemukan
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Cek password hash
        if (password_verify($password, $user['password'])) {

            // Set session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['first_name'];

            // Redirect sesuai role
            if ($user['role'] == 'admin') {
                header("Location: ../dashboard/admin.php");
            } else {
                header("Location: ../dashboard/customer.php");
            }
            exit;

        } else {
            echo "<script>alert('Password salah!'); window.location='../pages/signin.php';</script>";
            exit;
        }

    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.location='../pages/signin.php';</script>";
        exit;
    }
}
?>
