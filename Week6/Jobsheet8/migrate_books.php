<?php

require __DIR__ . '/includes/connection.php';

$oldBooks = [
    ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'year' => 2005, 'stock' => 4, 'category' => 'fiction'],
    ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'year' => 1980, 'stock' => 2, 'category' => 'fiction'],
    ['title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'year' => 2009, 'stock' => 0, 'category' => 'fiction'],
    ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'year' => 2018, 'stock' => 5, 'category' => 'non-fiction'],
    ['title' => 'Ronggeng Dukuh Paruk', 'author' => 'Ahmad Tohari', 'year' => 1982, 'stock' => 1, 'category' => 'fiction'],
    ['title' => 'Cantik Itu Luka', 'author' => 'Eka Kurniawan', 'year' => 2002, 'stock' => 3, 'category' => 'fiction'],
    ['title' => 'Pulang', 'author' => 'Tere Liye', 'year' => 2015, 'stock' => 2, 'category' => 'fiction'],
    ['title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'year' => 2006, 'stock' => 6, 'category' => 'fiction'],
    ['title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'year' => 2009, 'stock' => 0, 'category' => 'fiction'],
    ['title' => 'Gadis Kretek', 'author' => 'Ratih Kumala', 'year' => 2012, 'stock' => 4, 'category' => 'fiction'],
];

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);

$inserted = 0;
foreach ($oldBooks as $book) {
    $stmt->execute([
        'title' => $book['title'],
        'author' => $book['author'],
        'year' => $book['year'],
        'isbn' => '',
        'stock' => $book['stock'],
        'category' => $book['category'],
    ]);
    $inserted++;
}

echo $inserted . " book(s) migrated from the old jobsheet-06 data into the books table." . PHP_EOL;
echo "Open buku/list.php to see them alongside anything already added through the form." . PHP_EOL;
