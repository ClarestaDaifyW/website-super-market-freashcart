<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../config/database.php";

if (isset($_POST['register'])) {

    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role       = "customer";
    $created_at = date("Y-m-d H:i:s");

    // Cek email sudah terdaftar
    $check = $conn->prepare("SELECT id_user FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='../pages/signup.php';</script>";
        exit;
    }

    // Insert user baru
    $stmt = $conn->prepare("INSERT INTO users 
        (first_name, last_name, email, password, phone, role, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssss",
        $first_name,
        $last_name,
        $email,
        $password,
        $phone,
        $role,
        $created_at
    );

    if ($stmt->execute()) {
        // Langsung redirect tanpa popup
        header("Location: ../pages/signin.php");
        exit;
    } else {
        echo "<script>alert('Gagal mendaftar!'); window.location='../pages/signup.php';</script>";
    }
}
?>
