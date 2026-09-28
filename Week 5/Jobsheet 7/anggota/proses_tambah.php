<?php
session_start();

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$telepon = trim($_POST['telepon'] ?? '');
$email = trim($_POST['email'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Name is required.";
}
if ($no_anggota === '') {
    $errors[] = "Member No. is required.";
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'telepon' => $telepon,
    'email' => $email,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member added successfully.'];
header('Location: list.php');
exit;
