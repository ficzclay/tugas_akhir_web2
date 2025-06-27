<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
  :root {
    --primary: #4e73df;
    --primary-dark: #2e59d9;
    --secondary: #858796;
    --light: #f8f9fc;
    --dark: #2a2a2a;
    --border: #e3e6f0;
  }

  body {
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    background-color: #f8f9fc;
    color: var(--dark);
    line-height: 1.6;
  }

  /* Header Styles */
  header {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    padding: 0.8rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .logo {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
  }

  /* Navigation Styles */
  nav {
    display: flex;
    gap: 1.5rem;
  }

  nav a {
    color: var(--dark);
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem 0;
    position: relative;
    transition: color 0.3s ease;
  }

  nav a:hover {
    color: var(--primary);
  }

  nav a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary);
    transition: width 0.3s ease;
  }

  nav a:hover::after {
    width: 100%;
  }

  nav a.text-danger {
    color: #dc3545;
  }

  nav a.text-danger:hover {
    color: #c82333;
  }

  nav a.text-danger::after {
    background-color: #dc3545;
  }

  /* Main Content Styles */
  #wrapper {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 20px;
  }

  /* Card Styles */
  .card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    border: none;
    margin-bottom: 2rem;
  }

  .card-header {
    background-color: white;
    border-bottom: 1px solid var(--border);
    padding: 1.25rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 8px 8px 0 0 !important;
  }

  .card-body {
    padding: 1.5rem;
  }

  /* Hamburger Menu Styles */
  .hamburger {
    display: none;
    cursor: pointer;
    padding: 10px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: var(--dark);
  }

  /* Mobile Navigation Styles */
  .mobile-nav {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    z-index: 999;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2rem;
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out;
  }

  .mobile-nav.active {
    transform: translateX(0);
  }

  .mobile-nav a {
    font-size: 1.2rem;
    color: var(--dark);
    text-decoration: none;
    padding: 0.5rem 1rem;
  }

  .mobile-nav a.text-danger {
    color: #dc3545;
  }

  .close-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 1.5rem;
    background: none;
    border: none;
    cursor: pointer;
    color: var(--dark);
  }

  /* Responsive Styles */
  @media (max-width: 768px) {
    .header-container {
      padding: 0.8rem 20px;
    }

    nav {
      display: none;
    }

    .hamburger {
      display: block;
    }

    .mobile-nav {
      display: flex;
    }
  }
  </style>
</head>

<body>
  <header>
    <div class="header-container">
      <a href="<?= base_url('admin/artikel'); ?>" class="logo">
        <i class="fas fa-newspaper"></i> Admin Portal
      </a>
      <nav>
        <a href="<?= base_url('admin/artikel'); ?>">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="<?= base_url('/artikel'); ?>">
          <i class="fas fa-list"></i> Artikel
        </a>
        <a href="<?= base_url('admin/artikel/add'); ?>">
          <i class="fas fa-plus"></i> Tambah Artikel
        </a>
        <a href="<?= base_url('user/logout'); ?>" class="text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </nav>
      <button class="hamburger" id="hamburger">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </header>

  <!-- Mobile Navigation -->
  <div class="mobile-nav" id="mobileNav">
    <button class="close-btn" id="closeBtn">
      <i class="fas fa-times"></i>
    </button>
    <a href="<?= base_url('admin/artikel'); ?>">
      <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="<?= base_url('/artikel'); ?>">
      <i class="fas fa-list"></i> Artikel
    </a>
    <a href="<?= base_url('admin/artikel/add'); ?>">
      <i class="fas fa-plus"></i> Tambah Artikel
    </a>
    <a href="<?= base_url('user/logout'); ?>" class="text-danger">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
  </div>

  <div id="wrapper">
    <section id="main">
      <?= $this->renderSection('content') ?>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Hamburger menu functionality
  const hamburger = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobileNav');
  const closeBtn = document.getElementById('closeBtn');

  hamburger.addEventListener('click', () => {
    mobileNav.classList.add('active');
  });

  closeBtn.addEventListener('click', () => {
    mobileNav.classList.remove('active');
  });

  // Close mobile menu when clicking on a link
  const mobileLinks = mobileNav.querySelectorAll('a');
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      mobileNav.classList.remove('active');
    });
  });
  </script>
</body>

</html>