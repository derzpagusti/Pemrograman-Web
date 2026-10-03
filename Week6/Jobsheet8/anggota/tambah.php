<?php
$page_title = "Add Member";
include __DIR__ . '/../includes/header.php';
?>
        <section>
            <h2>Add Member</h2>
            <?php if ($flash = $_SESSION['flash'] ?? null): unset($_SESSION['flash']); ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form id="form-tambah" method="post" action="proses_tambah.php">
                <p>
                    <label for="nama">Name</label><br>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="no_anggota">Member No.</label><br>
                    <input type="text" id="no_anggota" name="no_anggota" required>
                </p>
                <p>
                    <label for="alamat">Address</label><br>
                    <input type="text" id="alamat" name="alamat">
                </p>
                <p>
                    <label for="telepon">Phone No.</label><br>
                    <input type="text" id="telepon" name="telepon">
                </p>
                <p>
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email">
                </p>
                <p>
                    <button type="submit">Save</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
