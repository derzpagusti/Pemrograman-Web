<?php
session_start();
require __DIR__ . '/../includes/connection.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];
if ($judul === '') {
    $errors[] = "Title is required.";
}
if ($pengarang === '') {
    $errors[] = "Author is required.";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Year must be between 1900 and 2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stock cannot be negative.";
}

if ($isbn !== '' && !preg_match('/^[0-9-]+$/', $isbn)) {
    $errors[] = "ISBN may only contain digits and hyphens.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);
$stmt->execute([
    'title' => $judul,
    'author' => $pengarang,
    'year' => (int) $tahun,
    'isbn' => $isbn,
    'stock' => (int) $stok,
    'category' => $kategori,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Book added successfully.'];
header('Location: list.php');
exit;
