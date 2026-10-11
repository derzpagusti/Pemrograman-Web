<?php
$page_title = "Edit Book";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/connection.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>
        <section>
            <h2>Edit Book</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form id="form-tambah" method="post" action="proses_edit.php">
                <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                <p>
                    <label for="judul">Title</label><br>
                    <input type="text" id="judul" name="judul" value="<?php echo $buku['title']; ?>" required>
                </p>
                <p>
                    <label for="pengarang">Author</label><br>
                    <input type="text" id="pengarang" name="pengarang" value="<?php echo $buku['author']; ?>" required>
                </p>
                <p>
                    <label for="tahun">Year Published</label><br>
                    <input type="number" id="tahun" name="tahun" min="1900" max="2026" value="<?php echo $buku['year']; ?>" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label><br>
                    <input type="text" id="isbn" name="isbn" value="<?php echo $buku['isbn']; ?>">
                </p>
                <p>
                    <label for="stok">Stock</label><br>
                    <input type="number" id="stok" name="stok" min="0" value="<?php echo $buku['stock']; ?>" required>
                </p>
                <p>
                    <label for="kategori">Category</label><br>
                    <select id="kategori" name="kategori">
                        <?php foreach (['fiction' => 'Fiction', 'non-fiction' => 'Non-Fiction', 'reference' => 'Reference'] as $value => $label): ?>
                        <option value="<?php echo $value; ?>" <?php echo $buku['category'] === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <p>
                    <button type="submit">Save Changes</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
