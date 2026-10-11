<?php
$page_title = "Librarian Login";
include __DIR__ . '/includes/header.php';
?>
        <section>
            <h2>Librarian Login</h2>
            <form>
                <p>
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" required>
                </p>
                <p>
                    <button type="submit">Sign In</button>
                </p>
            </form>
            <p>No account yet? <a href="anggota/tambah.php">Register here</a></p>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
