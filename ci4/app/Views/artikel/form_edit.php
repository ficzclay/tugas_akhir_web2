<?= $this->include('template/admin_header'); ?>
<!-- Google Font & Modern Design -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
:root {
  --primary: #4361ee;
  --primary-hover: #3a56d4;
  --light-bg: #f9fafb;
  --border: #e5e7eb;
  --text: #374151;
  --text-light: #6b7280;
  --white: #ffffff;
  --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', sans-serif;
  background-color: var(--light-bg);
  color: var(--text);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.container {
  width: 100%;
  max-width: 100%;
  flex: 1;
  padding: 0;
}

.form-header {
  background-color: var(--white);
  padding: 1.5rem 2rem;
  border-bottom: 1px solid var(--border);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.form-header h1 {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--text);
  margin: 0;
}

.form-content {
  padding: 2rem;
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 2rem;
}

.content-main {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.content-sidebar {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.card {
  background-color: var(--white);
  border-radius: 0.5rem;
  box-shadow: var(--shadow);
  padding: 1.5rem;
}

label {
  font-weight: 500;
  font-size: 0.9rem;
  color: var(--text);
}

input[type="text"],
textarea,
select {
  padding: 0.75rem 1rem;
  border: 1px solid var(--border);
  border-radius: 0.375rem;
  font-size: 0.95rem;
  width: 100%;
  color: var(--text);
  background-color: var(--white);
  transition: border-color 0.15s ease;
}

input[type="text"]:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
}

textarea {
  min-height: 300px;
  resize: vertical;
}

.file-input {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.file-upload {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  border: 2px dashed var(--border);
  border-radius: 0.5rem;
  background-color: var(--light-bg);
  cursor: pointer;
  transition: all 0.2s ease;
}

.file-upload:hover {
  border-color: var(--primary);
}

.file-upload i {
  font-size: 2rem;
  color: var(--text-light);
  margin-bottom: 0.5rem;
}

.file-upload p {
  font-size: 0.9rem;
  color: var(--text-light);
  margin: 0;
  text-align: center;
}

.file-upload input[type="file"] {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  opacity: 0;
  cursor: pointer;
}

.preview-image {
  width: 100%;
  height: auto;
  border-radius: 0.375rem;
  object-fit: cover;
}

.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  font-size: 0.95rem;
  font-weight: 500;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: all 0.2s ease;
  border: none;
}

.btn-primary {
  background-color: var(--primary);
  color: var(--white);
}

.btn-primary:hover {
  background-color: var(--primary-hover);
}

.btn-secondary {
  background-color: var(--white);
  color: var(--text);
  border: 1px solid var(--border);
}

.btn-secondary:hover {
  background-color: var(--light-bg);
}

.btn i {
  margin-right: 0.5rem;
}

.action-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1rem;
}

@media screen and (max-width: 768px) {
  .form-content {
    grid-template-columns: 1fr;
  }

  .form-header {
    padding: 1rem;
  }

  .form-content {
    padding: 1rem;
  }
}
</style>

<div class="container">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-header">
      <h1><?= $title; ?></h1>
      <div class="action-buttons">
        <button type="button" class="btn btn-secondary" onclick="history.back()">
          <i class="fas fa-arrow-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> Simpan Artikel
        </button>
      </div>
    </div>

    <div class="form-content">
      <div class="content-main">
        <div class="card">
          <div class="form-group">
            <label for="judul">Judul Artikel</label>
            <input type="text" name="judul" id="judul" value="<?= isset($data['judul']) ? $data['judul'] : ''; ?>"
              placeholder="Masukkan judul artikel" required>
          </div>
        </div>

        <div class="card">
          <div class="form-group">
            <label for="isi">Isi Artikel</label>
            <textarea name="isi" id="isi" placeholder="Tulis isi artikel..."
              required><?= isset($data['isi']) ? $data['isi'] : ''; ?></textarea>
          </div>
        </div>
      </div>

      <div class="content-sidebar">
        <div class="card">
          <div class="form-group">
            <label for="id_kategori">Kategori</label>
            <select name="id_kategori" id="id_kategori" required>
              <option value="">Pilih Kategori</option>
              <?php foreach ($kategori as $cat): ?>
              <option value="<?= $cat['id_kategori']; ?>"
                <?= (isset($data['id_kategori']) && $data['id_kategori'] == $cat['id_kategori']) ? 'selected' : ''; ?>>
                <?= $cat['nama_kategori']; ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>


        <!-- Status -->
        <div class="card">
          <div class="form-group">
            <label for="status">Status Artikel</label>
            <select name="status" id="status" required>
              <option value="1" <?= (isset($data['status']) && $data['status'] == 1) ? 'selected' : ''; ?>>Publish
              </option>
              <option value="0" <?= (isset($data['status']) && $data['status'] == 0) ? 'selected' : ''; ?>>Draft
              </option>
            </select>
          </div>
        </div>

        <div class="card">
          <div class="form-group">
            <label>Gambar Artikel</label>
            <div class="file-input">
              <div class="file-upload">
                <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(this)">
                <div class="upload-content">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <p>Klik atau drop gambar di sini</p>
                </div>
              </div>

              <?php if (isset($data['gambar']) && $data['gambar']): ?>
              <div id="image-preview-container">
                <img src="<?= base_url('uploads/' . $data['gambar']); ?>" alt="Gambar Artikel" class="preview-image"
                  id="image-preview">
              </div>
              <?php else: ?>
              <div id="image-preview-container" style="display: none;">
                <img src="" alt="Preview" class="preview-image" id="image-preview">
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
function previewImage(input) {
  const previewContainer = document.getElementById('image-preview-container');
  const preview = document.getElementById('image-preview');

  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function(e) {
      preview.src = e.target.result;
      previewContainer.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?= $this->include('template/admin_footer'); ?>