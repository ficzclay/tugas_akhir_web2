<?= $this->include('template/admin_header'); ?>

<div class="admin-container">
  <div class="admin-content">
    <div class="form-card">
      <div class="form-header">
        <h1 class="form-title"><?= $title ?></h1>
        <p class="form-subtitle">
          <?= isset($artikel['id']) ? 'Edit artikel yang sudah ada' : 'Buat artikel baru untuk dipublikasikan' ?>
        </p>
      </div>

      <form action="" method="post" enctype="multipart/form-data" class="form-grid">
        <div class="form-group">
          <label for="judul" class="form-label">Judul Artikel <span class="required">*</span></label>
          <input type="text" id="judul" name="judul" class="form-control"
            placeholder="Contoh: Cara Membuat Website Modern"
            value="<?= isset($artikel['judul']) ? esc($artikel['judul']) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="isi" class="form-label">Isi Artikel <span class="required">*</span></label>
          <textarea id="isi" name="isi" class="form-control" placeholder="Tulis konten artikel Anda di sini..."
            required><?= isset($artikel['isi']) ? esc($artikel['isi']) : '' ?></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select id="id_kategori" name="id_kategori" class="form-control">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach($kategori as $k): ?>
              <option value="<?= $k['id_kategori']; ?>"
                <?= (isset($artikel['id_kategori']) && $artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                <?= esc($k['nama_kategori']); ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control">
              <option value="0" <?= isset($data['status']) && $data['status'] == 0 ? 'selected' : '' ?>>Draft</option>
              <option value="1" <?= isset($data['status']) && $data['status'] == 1 ? 'selected' : '' ?>>Publish</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Gambar Utama</label>
          <div class="file-upload">
            <input type="file" id="gambar" name="gambar" class="file-upload-input" accept="image/*">
            <label for="gambar" class="file-upload-label">
              <div class="file-upload-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <div class="file-upload-text">Unggah Gambar</div>
                <div class="file-upload-hint">PNG, JPG maksimal 2MB</div>
              </div>
            </label>
          </div>
          <div class="preview-container" id="previewContainer">
            <img src="" alt="Preview" class="preview-image" id="previewImage">
            <button type="button" class="remove-image-btn" id="removeImageBtn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        </div>

        <div class="form-actions">
          <a href="<?= base_url('admin/artikel') ?>" class="cancel-btn">
            Batal
          </a>
          <button type="submit" class="submit-btn">
            <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
              <polyline points="17 21 17 13 7 13 7 21"></polyline>
              <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            <?= isset($artikel['id']) ? 'Update Artikel' : 'Simpan Artikel' ?>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
:root {
  --primary: #4F46E5;
  --primary-light: #6366F1;
  --primary-lighter: #818CF8;
  --primary-lightest: #EEF2FF;
  --success: #10B981;
  --danger: #EF4444;
  --warning: #F59E0B;
  --info: #3B82F6;
  --text: #1F2937;
  --text-light: #6B7280;
  --text-lighter: #9CA3AF;
  --background: #F9FAFB;
  --card-bg: #FFFFFF;
  --border: #E5E7EB;
  --border-dark: #D1D5DB;
  --border-radius: 12px;
  --border-radius-sm: 8px;
  --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --transition: all 0.2s ease-in-out;
}

* {
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
  background-color: var(--background);
  color: var(--text);
  line-height: 1.5;
  margin: 0;
  padding: 0;
}

.admin-container {
  display: flex;
  min-height: 100vh;
}

.admin-content {
  flex: 1;
  padding: 2rem;
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
}

.form-card {
  background: var(--card-bg);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-lg);
  padding: 2.5rem;
  border: 1px solid var(--border);
  transition: var(--transition);
  max-width: 800px;
  margin: 0 auto;
}

.form-header {
  text-align: center;
  margin-bottom: 2rem;
}

.form-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--text);
  margin: 0 0 0.5rem 0;
  letter-spacing: -0.025em;
}

.form-subtitle {
  color: var(--text-light);
  font-size: 0.875rem;
  margin: 0 auto;
  max-width: 80%;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  position: relative;
}

.form-label {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text);
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
}

.required {
  color: var(--danger);
  margin-left: 0.25rem;
}

.form-control {
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 0.875rem;
  border: 1px solid var(--border);
  border-radius: var(--border-radius-sm);
  transition: var(--transition);
  background-color: var(--card-bg);
  color: var(--text);
  font-family: inherit;
}

.form-control::placeholder {
  color: var(--text-lighter);
  opacity: 0.7;
}

.form-control:focus {
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
  outline: none;
}

select.form-control {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239CA3AF' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 1rem;
  padding-right: 2.5rem;
}

textarea.form-control {
  min-height: 200px;
  resize: vertical;
  line-height: 1.6;
  padding: 1rem;
}

.file-upload {
  position: relative;
  overflow: hidden;
}

.file-upload-input {
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

.file-upload-label {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  background: var(--background);
  border: 2px dashed var(--border);
  border-radius: var(--border-radius-sm);
  text-align: center;
  cursor: pointer;
  transition: var(--transition);
}

.file-upload-label:hover {
  border-color: var(--primary);
  background: rgba(99, 102, 241, 0.05);
}

.file-upload-icon {
  display: flex;
  flex-direction: column;
  align-items: center;
  color: var(--text-light);
  margin-bottom: 0.5rem;
}

.file-upload-icon svg {
  width: 2rem;
  height: 2rem;
  margin-bottom: 0.5rem;
  stroke-width: 1.5;
  color: var(--primary);
}

.file-upload-text {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text);
}

.file-upload-hint {
  font-size: 0.75rem;
  color: var(--text-light);
  margin-top: 0.25rem;
}

.preview-container {
  margin-top: 1rem;
  display: none;
  position: relative;
}

.preview-image {
  max-width: 100%;
  max-height: 200px;
  border-radius: var(--border-radius-sm);
  border: 1px solid var(--border);
  display: block;
}

.remove-image-btn {
  position: absolute;
  top: 0.5rem;
  right: 0.5rem;
  background: var(--danger);
  color: white;
  border: none;
  border-radius: 50%;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  padding: 0;
  transition: var(--transition);
}

.remove-image-btn:hover {
  background: #DC2626;
}

.remove-image-btn svg {
  width: 14px;
  height: 14px;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 1rem;
  margin-top: 1.5rem;
}

.cancel-btn {
  padding: 0.75rem 1.5rem;
  font-size: 0.875rem;
  font-weight: 500;
  border-radius: var(--border-radius-sm);
  cursor: pointer;
  transition: var(--transition);
  border: 1px solid var(--border);
  background: white;
  color: var(--text);
  text-decoration: none;
}

.cancel-btn:hover {
  background: #F3F4F6;
}

.submit-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  font-size: 0.875rem;
  font-weight: 500;
  border-radius: var(--border-radius-sm);
  cursor: pointer;
  transition: var(--transition);
  border: none;
  background: var(--primary);
  color: white;
  box-shadow: var(--shadow);
}

.submit-btn:hover {
  background: var(--primary-light);
  transform: translateY(-1px);
  box-shadow: var(--shadow-md);
}

.submit-btn:active {
  transform: translateY(0);
}

.btn-icon {
  margin-right: 0.5rem;
  width: 1rem;
  height: 1rem;
}

@media (max-width: 768px) {
  .admin-content {
    padding: 1.5rem;
  }

  .form-card {
    padding: 1.5rem;
  }

  .form-row {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .form-actions {
    flex-direction: column-reverse;
    align-items: stretch;
  }

  .cancel-btn,
  .submit-btn {
    width: 100%;
  }
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(5px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-group {
  animation: fadeIn 0.3s ease-out forwards;
  opacity: 0;
}

.form-group:nth-child(1) {
  animation-delay: 0.1s;
}

.form-group:nth-child(2) {
  animation-delay: 0.2s;
}

.form-group:nth-child(3) {
  animation-delay: 0.3s;
}

.form-group:nth-child(4) {
  animation-delay: 0.4s;
}

.form-group:nth-child(5) {
  animation-delay: 0.5s;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const fileInput = document.getElementById('gambar');
  const previewContainer = document.getElementById('previewContainer');
  const previewImage = document.getElementById('previewImage');
  const removeImageBtn = document.getElementById('removeImageBtn');

  // If editing and image exists, show it
  <?php if (isset($artikel['gambar']) && !empty($artikel['gambar'])): ?>
  previewContainer.style.display = 'block';
  previewImage.src = '<?= base_url('uploads/' . esc($artikel['gambar'])) ?>';
  <?php endif; ?>

  // Handle new image upload
  fileInput.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        previewImage.src = e.target.result;
        previewContainer.style.display = 'block';
      }

      reader.readAsDataURL(this.files[0]);
    }
  });

  // Handle image removal
  removeImageBtn.addEventListener('click', function() {
    previewImage.src = '';
    previewContainer.style.display = 'none';
    fileInput.value = '';

    <?php if (isset($artikel['gambar']) && !empty($artikel['gambar'])): ?>
    // Add a hidden input to indicate image removal if editing
    const existingInput = document.querySelector('input[name="remove_image"]');
    if (!existingInput) {
      const hiddenInput = document.createElement('input');
      hiddenInput.type = 'hidden';
      hiddenInput.name = 'remove_image';
      hiddenInput.value = '1';
      document.querySelector('form').appendChild(hiddenInput);
    }
    <?php endif; ?>
  });
});
</script>

<?= $this->include('template/admin_footer'); ?>