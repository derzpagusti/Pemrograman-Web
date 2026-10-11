<?php
$page_title = "Edit Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/connection.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}
?>
        <section>
            <h2>Edit Member</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">
                <p>
                    <label for="nama">Name</label><br>
                    <input type="text" id="nama" name="nama" value="<?php echo $anggota['name']; ?>" required>
                </p>
                <p>
                    <label for="no_anggota">Member No.</label><br>
                    <input type="text" id="no_anggota" name="no_anggota" value="<?php echo $anggota['member_id']; ?>" required>
                </p>
                <p>
                    <label for="alamat">Address</label><br>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $anggota['address']; ?>">
                </p>
                <p>
                    <label for="telepon">Phone No.</label><br>
                    <input type="text" id="telepon" name="telepon" value="<?php echo $anggota['phone']; ?>">
                </p>
                <p>
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" value="<?php echo $anggota['email']; ?>">
                </p>
                <p>
                    <button type="submit">Save Changes</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
