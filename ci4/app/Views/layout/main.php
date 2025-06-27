<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'My Website' ?></title>
  <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>

<body>
  <div id="container">

    <section id="wrapper">
      <section id="main">
        <?= $this->renderSection('content') ?>
      </section>
      <aside id="sidebar">
        <?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => $_GET['kategori'] ?? null]) ?>

      </aside>
    </section>
    <footer>
      <p>&copy; 2024 - Universitas Pelita Bangsa</p>
    </footer>
  </div>
</body>

</html>