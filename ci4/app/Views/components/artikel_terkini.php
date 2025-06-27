<?= $this->include('template/header'); ?>
<div class="artikel-terkini">
  <h3>Artikel Terkini</h3>

  <?php if (!empty($artikel)): ?>
  <ul>
    <?php foreach ($artikel as $row): ?>
    <li style="margin-bottom: 1rem;">
      <a href="<?= base_url('/artikel/' . esc($row['slug'])) ?>" style="font-weight: bold;">
        <?= esc($row['judul']) ?>
      </a><br>
      <small>Diposting pada: <?= date('d M Y H:i', strtotime($row['created_at'])); ?></small><br>
      <span class="kategori">Kategori: <?= esc($row['nama_kategori'] ?? 'Tidak diketahui'); ?></span>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php else: ?>
  <p>Belum ada artikel terkini.</p>
  <?php endif; ?>
</div>