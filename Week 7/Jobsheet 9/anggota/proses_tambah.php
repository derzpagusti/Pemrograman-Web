<?php
session_start();
require __DIR__ . '/../includes/connection.php';

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

$stmt = $pdo->prepare(
    "INSERT INTO members (name, member_id, address, phone, email)
     VALUES (:name, :member_id, :address, :phone, :email)
     RETURNING id"
);

try {
    $stmt->execute([
        'name' => $nama,
        'member_id' => $no_anggota,
        'address' => $alamat,
        'phone' => $telepon,
        'email' => $email,
    ]);
} catch (PDOException $e) {
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Member No. already in use, please choose a different number.'];
        header('Location: tambah.php');
        exit;
    }
    throw $e;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member added successfully.'];
header('Location: list.php');
exit;
