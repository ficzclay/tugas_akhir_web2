<?= $this->include('template/header'); ?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold">Manajemen Artikel</h2>
    <button class="btn btn-success" id="btnTambah" data-bs-toggle="modal" data-bs-target="#artikelModal">+ Tambah
      Artikel</button>
  </div>

  <!-- Filter Kategori -->
  <div class="row mb-3">
    <div class="col-md-4">
      <select id="filterKategori" class="form-select">
        <option value="">🔍 Semua Kategori</option>
        <option value="Teknologi">Teknologi</option>
        <option value="Pendidikan">Pendidikan</option>
        <option value="Olahraga">Olahraga</option>
        <!-- Tambahkan sesuai kategori yang kamu miliki -->
      </select>
    </div>
  </div>

  <!-- Tabel Artikel -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle" id="artikelTable">
      <thead class="table-dark">
        <tr>
          <th width="5%">ID</th>
          <th>Judul</th>
          <th>Kategori</th>
          <th>Status</th>
          <th width="20%">Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div id="pagination" class="mt-3 d-flex flex-wrap gap-2"></div>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="artikelModal" tabindex="-1" aria-labelledby="artikelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="artikelForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="artikelModalLabel">Tambah Artikel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="artikelId">
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" class="form-control" id="judul" required>
        </div>
        <div class="mb-3">
          <label for="isi" class="form-label">Isi</label>
          <textarea class="form-control" id="isi" rows="4" required></textarea>
        </div>
        <div class="mb-3">
          <label for="kategori" class="form-label">Kategori</label>
          <select class="form-select" id="kategori" required>
            <option value="">Pilih Kategori</option>
            <option value="Teknologi">Teknologi</option>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Olahraga">Olahraga</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" required>
            <option value="Draft">Draft</option>
            <option value="Publish">Publish</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
  function showLoading() {
    $('#artikelTable tbody').html('<tr><td colspan="5" class="text-center">⏳ Memuat data...</td></tr>');
  }

  function loadData(kategori = '', page = 1) {
    showLoading();
    $.ajax({
      url: "<?= base_url('ajax/getData') ?>",
      method: "GET",
      data: {
        kategori: kategori,
        page: page
      },
      dataType: "json",
      success: function(response) {
        const data = response.data;
        const totalPages = response.totalPages;
        const currentPage = response.currentPage;

        let rows = '';
        if (data.length === 0) {
          rows = '<tr><td colspan="5" class="text-center text-muted">Tidak ada artikel.</td></tr>';
        } else {
          data.forEach(row => {
            rows += `<tr>
              <td>${row.id}</td>
              <td>${row.judul}</td>
              <td>${row.nama_kategori}</td>

              <td><span class="badge ${row.status === 'Publish' ? 'bg-success' : 'bg-secondary'}">${row.status}</span></td>
              <td>
                <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}">Edit</button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">Delete</button>
              </td>
            </tr>`;
          });
        }
        $('#artikelTable tbody').html(rows);

        // Pagination
        let pagin = '';
        for (let i = 1; i <= totalPages; i++) {
          pagin +=
            `<button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-outline-secondary'} btn-page" data-page="${i}">${i}</button>`;
        }
        $('#pagination').html(pagin);
      }
    });
  }

  loadData();

  $('#filterKategori').on('change', function() {
    loadData($(this).val(), 1);
  });

  $(document).on('click', '.btn-page', function() {
    const page = $(this).data('page');
    const kategori = $('#filterKategori').val();
    loadData(kategori, page);
  });

  $('#btnTambah').on('click', function() {
    $('#artikelForm')[0].reset();
    $('#artikelId').val('');
    $('#artikelModalLabel').text('Tambah Artikel');
  });

  $('#artikelForm').on('submit', function(e) {
    e.preventDefault();
    const id = $('#artikelId').val();
    const url = id ? `<?= base_url('ajax/edit/') ?>${id}` : "<?= base_url('ajax/save') ?>";
    $.ajax({
      url: url,
      method: "POST",
      data: {
        judul: $('#judul').val(),
        isi: $('#isi').val(),
        kategori: $('#kategori').val(),
        status: $('#status').val()
      },
      success: function() {
        $('#artikelModal').modal('hide');
        loadData($('#filterKategori').val());
      }
    });
  });

  $(document).on('click', '.btn-edit', function() {
    const id = $(this).data('id');
    $.get("<?= base_url('ajax/getData') ?>", function(response) {
      const artikel = response.data.find(row => row.id == id);
      if (artikel) {
        $('#artikelId').val(artikel.id);
        $('#judul').val(artikel.judul);
        $('#isi').val(artikel.isi);
        $('#kategori').val(artikel.kategori);
        $('#status').val(artikel.status);
        $('#artikelModalLabel').text('Edit Artikel');
        new bootstrap.Modal(document.getElementById('artikelModal')).show();
      }
    });
  });

  $(document).on('click', '.btn-delete', function() {
    const id = $(this).data('id');
    if (confirm('Yakin hapus artikel ini?')) {
      $.ajax({
        url: `<?= base_url('ajax/delete/') ?>${id}`,
        method: "DELETE",
        success: function() {
          loadData($('#filterKategori').val());
        }
      });
    }
  });
});
</script>

<?= $this->include('template/footer'); ?>