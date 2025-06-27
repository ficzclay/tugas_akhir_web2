<?= $this->include('template/header'); ?>

<div class="content-wrapper">
  <!-- Mobile Category Toggle -->
  <button class="mobile-category-toggle" id="mobileCategoryToggle">
    <i class="fas fa-filter"></i> Filter Categories
  </button>

  <!-- Categories Section -->
  <aside class="categories-sidebar" id="categoriesSidebar">
    <h3 class="sidebar-title">Explore Categories</h3>
    <ul class="category-list">
      <?php if ($kategori): foreach ($kategori as $cat): ?>
      <li
        class="category-item <?= (isset($current_category) && $current_category == $cat['id_kategori']) ? 'active' : '' ?>">
        <a href="<?= base_url('/kategori/' . $cat['id_kategori']); ?>" class="category-link">
          <?= $cat['nama_kategori']; ?>
          <?php if (isset($current_category) && $current_category == $cat['id_kategori']): ?>
          <span class="item-count">(<?= count($artikel) ?>)</span>
          <?php endif; ?>
        </a>
      </li>
      <?php endforeach; else: ?>
      <li class="category-item">No categories found</li>
      <?php endif; ?>
    </ul>
  </aside>

  <!-- Main Articles Grid -->
  <main class="articles-grid">
    <?php if ($artikel): foreach ($artikel as $row): ?>
    <article class="article-card">
      <div class="article-meta">
        <span
          class="article-category <?= (isset($current_category) && $current_category == $row['id_kategori']) ? 'active-category' : '' ?>">
          <?= $row['nama_kategori'] ?>
        </span>
        <time class="article-date"><?= date('M d, Y', strtotime($row['created_at'])); ?></time>
      </div>
      <div class="article-image-container">
        <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
          <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= $row['judul']; ?>" class="article-image"
            loading="lazy">
        </a>
      </div>
      <div class="article-content">
        <h2 class="article-title">
          <a href="<?= base_url('/artikel/' . $row['slug']); ?>"><?= $row['judul']; ?></a>
        </h2>
        <p class="article-excerpt"><?= substr(strip_tags($row['isi']), 0, 150); ?>...</p>
        <div class="article-footer">
          <a href="<?= base_url('/artikel/' . $row['slug']); ?>" class="read-more-button">
            Read More <span class="arrow">→</span>
          </a>
          <div class="article-actions">
            <button class="action-button" aria-label="Save article">
              <i class="far fa-bookmark"></i>
            </button>
            <button class="action-button" aria-label="Share article">
              <i class="fas fa-share-alt"></i>
            </button>
          </div>
        </div>
      </div>
    </article>
    <?php endforeach; else: ?>
    <div class="no-articles">
      <img src="<?= base_url('/assets/no-articles.svg'); ?>" alt="No articles" class="no-articles-image">
      <h3>No articles found</h3>
      <p>Check back later for new content</p>
      <a href="<?= base_url('/'); ?>" class="browse-button">Browse all articles</a>
    </div>
    <?php endif; ?>
  </main>
</div>

<?= $this->include('template/footer'); ?>

<style>
/* Base Styles */
:root {
  --primary-color: #4361ee;
  --primary-hover: #3a56d4;
  --text-color: #2b2d42;
  --light-text: #8d99ae;
  --background: #f8f9fa;
  --card-bg: #ffffff;
  --border-radius: 12px;
  --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  --transition: all 0.3s ease;
  --active-color: #3a0ca3;
  --active-bg: #f0f4ff;
  --mobile-breakpoint: 768px;
  --tablet-breakpoint: 992px;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  color: var(--text-color);
  background-color: var(--background);
  line-height: 1.6;
}

.content-wrapper {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 1.5rem;
  display: grid;
  grid-template-columns: 250px 1fr;
  gap: 2rem;
  position: relative;
}

/* Mobile Category Toggle */
.mobile-category-toggle {
  display: none;
  background-color: var(--primary-color);
  color: white;
  border: none;
  padding: 0.75rem 1.25rem;
  border-radius: var(--border-radius);
  font-weight: 500;
  margin-bottom: 1rem;
  cursor: pointer;
  align-items: center;
  gap: 0.5rem;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
}

.mobile-category-toggle:hover {
  background-color: var(--primary-hover);
}

.mobile-category-toggle i {
  font-size: 1rem;
}

/* Categories Sidebar */
.categories-sidebar {
  position: sticky;
  top: 6rem;
  align-self: start;
  height: fit-content;
  transition: transform 0.3s ease;
}

.sidebar-title {
  font-size: 1.1rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  color: var(--text-color);
  padding-bottom: 0.75rem;
  border-bottom: 1px solid #e0e0e0;
}

.category-list {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  list-style: none;
  padding: 0;
  margin: 0;
}

.category-item {
  transition: var(--transition);
}

.category-item.active {
  position: relative;
}

.category-item.active::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 3px;
  background: var(--active-color);
  border-radius: 3px 0 0 3px;
}

.category-link {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 1rem;
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  color: var(--text-color);
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 500;
  transition: var(--transition);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
}

.item-count {
  font-size: 0.8rem;
  color: var(--light-text);
  margin-left: 0.5rem;
}

.category-item.active .category-link {
  background-color: var(--active-bg);
  color: var(--active-color);
  font-weight: 600;
}

.category-link:hover {
  background-color: #f0f4ff;
  color: var(--primary-color);
}

/* Articles Grid */
.articles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
}

.article-card {
  background-color: var(--card-bg);
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--box-shadow);
  transition: var(--transition);
  display: flex;
  flex-direction: column;
}

.article-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.article-image-container {
  height: 200px;
  overflow: hidden;
  position: relative;
}

.article-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.article-card:hover .article-image {
  transform: scale(1.03);
}

.article-content {
  padding: 1.5rem;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.article-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
  font-size: 0.85rem;
  color: var(--light-text);
}

.article-category {
  background-color: #edf2ff;
  color: var(--primary-color);
  padding: 0.25rem 0.75rem;
  border-radius: 50px;
  font-weight: 500;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 120px;
}

.article-category.active-category {
  background-color: var(--active-bg);
  color: var(--active-color);
  font-weight: 600;
}

.article-date {
  color: var(--light-text);
}

.article-title {
  font-size: 1.25rem;
  margin: 0.5rem 0 1rem;
  font-weight: 600;
  line-height: 1.4;
  flex-grow: 1;
}

.article-title a {
  color: inherit;
  text-decoration: none;
  transition: var(--transition);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-title a:hover {
  color: var(--primary-color);
}

.article-excerpt {
  color: var(--light-text);
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.article-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: auto;
}

.read-more-button {
  display: inline-flex;
  align-items: center;
  color: var(--primary-color);
  font-weight: 500;
  text-decoration: none;
  transition: var(--transition);
}

.read-more-button:hover {
  color: var(--primary-hover);
}

.read-more-button .arrow {
  margin-left: 0.25rem;
  transition: var(--transition);
}

.read-more-button:hover .arrow {
  transform: translateX(3px);
}

.article-actions {
  display: flex;
  gap: 0.5rem;
}

.action-button {
  background: none;
  border: none;
  color: var(--light-text);
  cursor: pointer;
  padding: 0.25rem;
  transition: var(--transition);
}

.action-button:hover {
  color: var(--primary-color);
}

/* No Articles State */
.no-articles {
  grid-column: 1 / -1;
  text-align: center;
  padding: 3rem;
  color: var(--light-text);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.no-articles-image {
  width: 150px;
  height: 150px;
  margin-bottom: 1.5rem;
  opacity: 0.7;
}

.no-articles h3 {
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
  color: var(--text-color);
}

.no-articles p {
  margin-bottom: 1.5rem;
  max-width: 400px;
}

.browse-button {
  background-color: var(--primary-color);
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: var(--border-radius);
  text-decoration: none;
  font-weight: 500;
  transition: var(--transition);
}

.browse-button:hover {
  background-color: var(--primary-hover);
}

/* Responsive Design */
@media (max-width: 992px) {
  .content-wrapper {
    grid-template-columns: 200px 1fr;
    gap: 1.5rem;
  }

  .articles-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
  }
}

@media (max-width: 768px) {
  .content-wrapper {
    grid-template-columns: 1fr;
    padding: 0 1rem;
  }

  .mobile-category-toggle {
    display: flex;
  }

  .categories-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    background-color: var(--card-bg);
    z-index: 1000;
    padding: 1.5rem;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    transform: translateX(-100%);
    overflow-y: auto;
  }

  .categories-sidebar.active {
    transform: translateX(0);
  }

  .sidebar-title {
    margin-top: 1rem;
  }

  .category-list {
    flex-direction: column;
  }

  .articles-grid {
    grid-template-columns: 1fr;
  }

  .article-image-container {
    height: 180px;
  }
}

@media (max-width: 480px) {
  .article-footer {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .article-actions {
    width: 100%;
    justify-content: flex-end;
  }
}
</style>

<script>
// Mobile category sidebar toggle
const mobileCategoryToggle = document.getElementById('mobileCategoryToggle');
const categoriesSidebar = document.getElementById('categoriesSidebar');
const overlay = document.createElement('div');
overlay.className = 'sidebar-overlay';

// Create overlay element
overlay.style.position = 'fixed';
overlay.style.top = '0';
overlay.style.left = '0';
overlay.style.width = '100%';
overlay.style.height = '100%';
overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
overlay.style.zIndex = '999';
overlay.style.opacity = '0';
overlay.style.pointerEvents = 'none';
overlay.style.transition = 'opacity 0.3s ease';
document.body.appendChild(overlay);

mobileCategoryToggle.addEventListener('click', () => {
  categoriesSidebar.classList.toggle('active');
  if (categoriesSidebar.classList.contains('active')) {
    overlay.style.opacity = '1';
    overlay.style.pointerEvents = 'auto';
    document.body.style.overflow = 'hidden';
  } else {
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    document.body.style.overflow = '';
  }
});

overlay.addEventListener('click', () => {
  categoriesSidebar.classList.remove('active');
  overlay.style.opacity = '0';
  overlay.style.pointerEvents = 'none';
  document.body.style.overflow = '';
});

// Close sidebar when clicking on a category link in mobile view
const categoryLinks = document.querySelectorAll('.category-link');
categoryLinks.forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth <= 768) {
      categoriesSidebar.classList.remove('active');
      overlay.style.opacity = '0';
      overlay.style.pointerEvents = 'none';
      document.body.style.overflow = '';
    }
  });
});

// Handle window resize
window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    categoriesSidebar.classList.remove('active');
    overlay.style.opacity = '0';
    overlay.style.pointerEvents = 'none';
    document.body.style.overflow = '';
  }
});
</script>