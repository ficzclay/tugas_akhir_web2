<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Portal Berita'; ?></title>
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
    margin: 0;
    padding: 0;
  }

  /* Header Styles */
  header {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    padding: 1.5rem 0;
    text-align: center;
  }

  header h1 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--primary);
  }

  /* Navigation Styles */
  nav {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 0.8rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1.5rem;
  }

  nav a {
    color: var(--dark);
    text-decoration: none;
    font-weight: 500;
    margin-left: 1.4rem;
    padding: 0.5rem 0;
    position: relative;
    transition: all 0.3s ease;
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

  nav a.active {
    color: var(--primary);
    font-weight: 600;
  }

  nav a.active::after {
    width: 100%;
  }

  /* Main Content Styles */
  #wrapper {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 20px;
  }

  /* Footer Styles */
  footer {
    background-color: var(--dark);
    color: white;
    padding: 2rem 0;
    text-align: center;
    margin-top: 2rem;
  }

  /* Responsive Styles */
  @media (max-width: 768px) {
    .nav-container {
      gap: 1rem;
      justify-content: space-around;
    }

    header h1 {
      font-size: 1.8rem;
    }
  }
  </style>
</head>

<body>
  <div id="container">
    <header>
      <h1><i class="fas fa-newspaper"></i> Portal Berita</h1>
    </header>

    <nav>
      <div class="nav-container">
        <a href="<?= base_url('/'); ?>">
          <i class="fas fa-home"></i> Home
        </a>
        <a href="<?= base_url('/artikel'); ?>">
          <i class="fas fa-newspaper"></i> Artikel
        </a>
        <a href="<?= base_url('/about'); ?>">
          <i class="fas fa-info-circle"></i> About
        </a>
        <a href="<?= base_url('/contact'); ?>">
          <i class="fas fa-envelope"></i> Kontak
        </a>
        <a href="<?= base_url('admin/artikel'); ?>" class="active">
          <i class="fas fa-tachometer-alt"></i> Dashboard Admin
        </a>
      </div>
    </nav>

    <section id="wrapper">
      <section id="main">
        <?= $this->renderSection('content') ?>
      </section>
    </section>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>