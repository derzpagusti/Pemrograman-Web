<?php
$page_title = "Book List";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/connection.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$keyword = trim($_GET['keyword'] ?? '');

if ($keyword !== '') {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE title ILIKE :keyword ORDER BY id DESC");
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    $daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $daftarBuku = $pdo->query("SELECT * FROM books ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>
        <section>
            <h2>Book List</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <form method="get" action="list.php">
                    <div>
                        <label for="search-input">Search Book Title</label>
                        <input type="text" id="search-input" name="keyword"
                               value="<?php echo htmlspecialchars($keyword); ?>"
                               placeholder="Type a book title...">
                    </div>
                    <button type="submit">Search</button>
                </form>
            </div>
            <?php if ($keyword !== ''): ?>
                <p class="search-note">
                    Showing server-side search results for "<?php echo htmlspecialchars($keyword); ?>"
                    (<?php echo count($daftarBuku); ?> found) &mdash;
                    <a href="list.php">clear search</a>
                </p>
            <?php endif; ?>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Stock</th>
                            <th>Added On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="6">No book data yet. Please add one via the "Add Book" menu.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarBuku as $buku): ?>
                            <tr>
                                <td><?php echo $buku['title']; ?></td>
                                <td><?php echo $buku['author']; ?></td>
                                <td><?php echo $buku['year']; ?></td>
                                <td><?php echo $buku['stock']; ?></td>
                                <td><?php echo !empty($buku['tanggal_ditambahkan']) ? date('d M Y H:i', strtotime($buku['tanggal_ditambahkan'])) : '-'; ?></td>
                                <td>
                                    <button type="button">Edit</button>
                                    <button type="button" class="btn-hapus">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
