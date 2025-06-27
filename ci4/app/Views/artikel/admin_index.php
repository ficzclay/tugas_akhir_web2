<?php
// Admin Artikel View
?>
<?= $this->include('template/admin_header'); ?>

<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(120deg, #2c3e50, #fd746c);
  background-attachment: fixed;
  color: #fff;
  padding: 20px;
}

.form-search {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-bottom: 30px;
  background: rgba(255, 255, 255, 0.1);
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(10px);
}

.form-search input,
.form-search select {
  flex: 1;
  padding: 12px 16px;
  font-size: 15px;
  border: none;
  border-radius: 10px;
  background-color: rgba(255, 255, 255, 0.2);
  color: #000;
}

.form-search option {
  color: #000;
}

.form-search input::placeholder {
  color: #eee;
}

.form-search button.btn {
  background-color: #ffca28;
  color: #333;
  font-weight: bold;
  border: none;
  padding: 12px 24px;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.3s;
}

.form-search button.btn:hover {
  background-color: #ffa000;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.table th,
.table td {
  padding: 16px 20px;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  font-size: 14px;
  color: #000;
  background-color: rgba(255,255,255,0.85);
}

.table th {
  background-color: rgba(0, 0, 0, 0.3);
  font-weight: bold;
  color: #fff;
}

.table tbody tr:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

.pagination {
  display: flex;
  justify-content: center;
  margin: 30px 0 10px;
  gap: 10px;
  flex-wrap: wrap;
}

.pagination a,
.pagination span {
  padding: 10px 15px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.3);
  background-color: rgba(0, 0, 0, 0.2);
  text-decoration: none;
  color: #fff;
  font-weight: 500;
  transition: all 0.2s ease;
}

.pagination .active span {
  background-color: #ff7043;
  color: white;
  font-weight: bold;
  transform: scale(1.1);
}

#loading {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.6);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.loading-spinner {
  width: 80px;
  height: 80px;
  border: 10px solid #eee;
  border-top: 10px solid #ffca28;
  border-radius: 50%;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

footer {
  text-align: center;
  margin-top: 50px;
  color: #fff;
  background-color: transparent;
  padding: 20px;
  font-size: 14px;
}
</style>

<form id="filterForm" method="get" class="form-search">
  <input type="text" name="q" id="q" placeholder="Cari artikel...">

  <select name="kategori" id="kategori">
    <option value="">Semua Kategori</option>
    <?php foreach ($kategori as $cat): ?>
      <option value="<?= $cat['id_kategori']; ?>"><?= esc($cat['nama_kategori']); ?></option>
    <?php endforeach; ?>
  </select>

  <select name="sort" id="sort">
    <option value="">Urutkan</option>
    <option value="judul_asc">Judul A-Z</option>
    <option value="judul_desc">Judul Z-A</option>
  </select>

  <button type="submit" class="btn">Cari</button>
</form>

<div id="loading" style="display:none">
  <div class="loading-spinner"></div>
</div>

<div id="artikelTableContainer"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
function loadArtikel(page = 1) {
  $('#loading').show();
  const q = $('#q').val();
  const kategori = $('#kategori').val();
  const sort = $('#sort').val();

  $.ajax({
    url: `<?= base_url('admin/artikel') ?>?page=${page}`,
    type: 'GET',
    dataType: 'json',
    data: { q, kategori, sort },
    success: function(response) {
      setTimeout(() => {
        $('#loading').hide();

        if (response.success) {
          response.artikel.sort((a, b) => a.id - b.id);

          let html = '<table class="table">';
          html += '<thead><tr><th>ID</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead><tbody>';

          if (response.artikel.length > 0) {
            response.artikel.forEach(row => {
              html += `<tr>
                <td>${row.id}</td>
                <td><strong>${row.judul}</strong><br><small>${row.isi.substring(0, 50)}...</small></td>
                <td>${row.nama_kategori ?? 'Tidak ada'}</td>
                <td>${row.status == 1 ? 'Publish' : 'Draft'}</td>
                <td>
                  <a class="btn btn-primary" href="/admin/artikel/edit/${row.id}">Ubah</a>
                  <a class="btn btn-danger" href="/admin/artikel/delete/${row.id}" onclick="return confirm('Yakin menghapus data?');">Hapus</a>
                </td>
              </tr>`;
            });
          } else {
            html += '<tr><td colspan="5">Belum ada data.</td></tr>';
          }

          html += '</tbody></table>';
          html += `<div class="pagination">${response.pagination}</div>`;
          $('#artikelTableContainer').html(html);
        }
      }, 600);
    },
    error: function() {
      setTimeout(() => {
        $('#loading').hide();
        $('#artikelTableContainer').html('<p>Terjadi kesalahan saat memuat data.</p>');
      }, 500);
    }
  });
}

$(document).ready(function() {
  loadArtikel();

  $('#filterForm').on('submit', function(e) {
    e.preventDefault();
    loadArtikel();
  });

  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    const page = new URL($(this).attr('href')).searchParams.get('page') || 1;
    loadArtikel(page);
  });
});
</script>
