<?php
session_start();
require __DIR__ . '/../includes/connection.php';

$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

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
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE members SET name = :name, member_id = :member_id, address = :address,
     phone = :phone, email = :email WHERE id = :id"
);

try {
    $stmt->execute([
        'name' => $nama,
        'member_id' => $no_anggota,
        'address' => $alamat,
        'phone' => $telepon,
        'email' => $email,
        'id' => $id,
    ]);
} catch (PDOException $e) {
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Member No. already in use, please choose a different number.'];
        header('Location: edit.php?id=' . urlencode($id));
        exit;
    }
    throw $e;
}

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member updated successfully.'];
header('Location: list.php');
exit;
