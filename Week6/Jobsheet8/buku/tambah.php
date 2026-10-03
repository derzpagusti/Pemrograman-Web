<?php
$page_title = "Add Book";
include __DIR__ . '/../includes/header.php';
?>
        <section>
            <h2>Add Book</h2>
            <?php if ($flash = $_SESSION['flash'] ?? null): unset($_SESSION['flash']); ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form id="form-tambah" method="post" action="proses_tambah.php">
                <p>
                    <label for="judul">Title</label><br>
                    <input type="text" id="judul" name="judul" required>
                </p>
                <p>
                    <label for="pengarang">Author</label><br>
                    <input type="text" id="pengarang" name="pengarang" required>
                </p>
                <p>
                    <label for="tahun">Year Published</label><br>
                    <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label><br>
                    <input type="text" id="isbn" name="isbn">
                </p>
                <p>
                    <label for="stok">Stock</label><br>
                    <input type="number" id="stok" name="stok" min="0" required>
                </p>
                <p>
                    <label for="kategori">Category</label><br>
                    <select id="kategori" name="kategori">
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                        <option value="reference">Reference</option>
                    </select>
                </p>
                <p>
                    <button type="submit">Save</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
