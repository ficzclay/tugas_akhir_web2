<?= $this->include('template/header'); ?>

<!-- Bootstrap 5 & Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8fafc;
  color: #4a5568;
}

.article-card {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  padding: 30px;
  margin: 40px auto;
  max-width: 960px;
}

.article-title {
  font-size: 2rem;
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 15px;
  text-align: center;
}

.category-badge {
  background-color: #e6f0ff;
  color: #4361ee;
  padding: 6px 16px;
  border-radius: 30px;
  font-size: 0.85rem;
  font-weight: 600;
  text-transform: uppercase;
  display: inline-block;
  margin-bottom: 20px;
}

.article-image {
  width: 100%;
  height: auto;
  max-height: 400px;
  object-fit: cover;
  border-radius: 10px;
  margin: 20px 0;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.article-content {
  font-size: 1.1rem;
  line-height: 1.8;
  text-align: justify;
  color: #2d3748;
}

@media (max-width: 768px) {
  .article-title {
    font-size: 1.6rem;
  }

  .article-content {
    font-size: 1rem;
  }
}
</style>

<div class="container">
  <div class="article-card">
    <!-- Judul -->
    <h1 class="article-title"><?= esc($artikel['judul']); ?></h1>

    <!-- Kategori -->
    <div class="text-center">
      <span class="category-badge">Kategori: <?= esc($artikel['nama_kategori']); ?></span>
    </div>

    <!-- Gambar -->
    <?php if (!empty($artikel['gambar'])): ?>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= esc($artikel['judul']); ?>" class="article-image">
    <?php endif; ?>

    <!-- Isi Artikel -->
    <div class="article-content">
      <?= $artikel['isi']; ?>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->include('template/footer'); ?>
