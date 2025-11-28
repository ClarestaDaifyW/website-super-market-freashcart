<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Jika belum login → redirect
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/signin.php");
    exit;
}

// Include template FreshCart
include "../includes/header.php";
include "../includes/navbar.php";
?>

<div class="container mt-5">
    <h2 class="mb-3">Halo, <?= $_SESSION['name']; ?>
 👋</h2>
    <p>Selamat datang di Dashboard Customer FreshCart.</p>

    <div class="row mt-4">

        <!-- Box Riwayat Belanja -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Riwayat Pesanan</h5>
                <p>Lihat pesanan kamu.</p>
                <a href="#" class="btn btn-primary">Lihat</a>
            </div>
        </div>

        <!-- Box Profil -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Profil Saya</h5>
                <p>Edit informasi akun.</p>
                <a href="#" class="btn btn-success">Kelola</a>
            </div>
        </div>

        <!-- Box Logout -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Logout</h5>
                <p>Keluar dari akun.</p>
                <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

    </div>
</div>

<?php include "../includes/footer.php"; ?>
