<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';

$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
?>
        <section>
            <h2>Welcome to the Mini Library System</h2>
            <p>A simple application for managing library book and member data.</p>
        </section>
        <section>
            <h2>Summary</h2>
            <article>
                <h3>Total Books</h3>
                <p><?php echo $totalBuku; ?></p>
            </article>
            <article>
                <h3>Total Members</h3>
                <p><?php echo $totalAnggota; ?></p>
            </article>
            <article>
                <h3>On Loan</h3>
                <p>3</p>
            </article>
            <article>
                <h3>Overdue Books</h3>
                <p>1</p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
