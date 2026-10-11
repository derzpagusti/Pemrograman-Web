<?php
$page_title = "Member List";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/connection.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM members WHERE member_id ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM members WHERE member_id ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM members ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
        <section>
            <h2>Member List</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <form method="get" action="list.php">
                    <span>
                        <label for="search-input">Search Member No.</label><br>
                        <input type="text" id="search-input" name="q"
                               value="<?php echo $keyword; ?>"
                               placeholder="Type a member number...">
                    </span>
                    <button type="submit">Search</button>
                </form>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Member No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarAnggota)): ?>
                        <tr>
                            <td colspan="6">No member data found.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarAnggota as $anggota): ?>
                            <tr>
                                <td><?php echo $anggota['member_id']; ?></td>
                                <td><?php echo $anggota['name']; ?></td>
                                <td><?php echo $anggota['address']; ?></td>
                                <td><?php echo $anggota['phone']; ?></td>
                                <td><?php echo $anggota['email']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $anggota['id']; ?>" class="btn-edit">Edit</a>
                                    <form class="form-hapus" method="post" action="hapus.php">
                                        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">
                                        <button type="submit" class="btn-hapus">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <nav class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                   class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </nav>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
