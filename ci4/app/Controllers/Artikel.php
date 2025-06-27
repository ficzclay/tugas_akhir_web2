<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    // Menampilkan daftar artikel
  public function index()
{
    // Membuat objek model
    $artikelModel = new ArtikelModel();
    $kategoriModel = new KategoriModel();

    // Mengambil data artikel beserta kategori
    $artikel = $artikelModel->getArtikelDenganKategori();

    // Mengambil daftar kategori
    $kategori = $kategoriModel->getAllKategori();

    // Mengirimkan data ke view
    return view('artikel/index', [
        'artikel' => $artikel,
        'kategori' => $kategori,
        'current_category' => null // Tambahkan ini
    ]);
}

    // Menampilkan artikel berdasarkan slug
  public function view($slug)
{
    $model = new ArtikelModel();
    // Gabungkan artikel dengan kategori
    $artikel = $model->select('artikel.*, kategori.nama_kategori')
                     ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                     ->where(['slug' => $slug])
                     ->first();

    if (!$artikel) {
        throw PageNotFoundException::forPageNotFound();
    }

    $title = $artikel['judul'];
    return view('artikel/detail', compact('artikel', 'title'));
}


    // Menampilkan artikel admin dan pencarian
  public function admin_index()
{
    $title = 'Daftar Artikel';
    $q = $this->request->getVar('q') ?? '';
    $kategoriId = $this->request->getVar('kategori');
    $sort = $this->request->getVar('sort');

    $model = new ArtikelModel();
    $model->select('artikel.*, kategori.nama_kategori')
          ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

    if (!empty($q)) {
        $model->like('judul', $q)->orLike('isi', $q);
    }

    if (!empty($kategoriId)) {
        $model->where('artikel.id_kategori', $kategoriId);
    }

    // Sorting
    if ($sort == 'judul_asc') {
        $model->orderBy('judul', 'ASC');
    } elseif ($sort == 'judul_desc') {
        $model->orderBy('judul', 'DESC');
    }

    // AJAX: kembalikan dalam format JSON
   if ($this->request->isAJAX()) {
    $perPage = 5;
    $page = (int) $this->request->getVar('page') ?? 1;

    $artikel = $model->paginate($perPage, 'default', $page);
    $pager = $model->pager;

    return $this->response->setJSON([
        'success' => true,
        'artikel' => $artikel,
        'pagination' => $pager->makeLinks($page, $perPage, $model->pager->getTotal(), 'default_full')
    ]);
}


    // View biasa
    $data = [
        'title'   => $title,
        'q'       => $q,
        'selectedKategori' => $kategoriId,
        'kategori' => (new KategoriModel())->findAll(),
        'artikel' => $model->paginate(5),
        'pager'   => $model->pager,
    ];

    return view('artikel/admin_index', $data);
}



   public function search()
{
    $q = $this->request->getGet('q');  // Ambil query pencarian dari URL
    $kategoriId = $this->request->getGet('kategori');  // Ambil kategori yang dipilih

    // Ambil model artikel
    $artikelModel = new \App\Models\ArtikelModel();
    $query = $artikelModel->where('1=1');  // Mulai query dengan kondisi true

    // Filter berdasarkan kata kunci jika ada
    if ($q) {
        $query = $query->like('judul', $q)->orLike('isi', $q);
    }

    // Filter berdasarkan kategori jika ada
    if ($kategoriId) {
        $query = $query->where('id_kategori', $kategoriId);
    }

    // Ambil artikel yang sesuai dengan filter
    $artikel = $query->findAll();

    // Ambil data kategori untuk dropdown
    $kategoriModel = new \App\Models\KategoriModel();
    $kategori = $kategoriModel->findAll();  // Pastikan kategori diambil dengan benar

    // Kirim data ke view
    return view('artikel/admin_index', [
        'q' => $q,
        'selectedKategori' => $kategoriId,
        'kategori' => $kategori,  // Kirimkan kategori ke view
        'artikel' => $artikel,  // Kirimkan artikel yang ditemukan
    ]);
}




    // Menambahkan artikel baru
    public function add()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'id_kategori' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $file = $this->request->getFile('gambar');
            $namaGambar = '';

            if ($file && $file->isValid()) {
                // Pindahkan file gambar ke folder gambar
                $file->move(ROOTPATH . 'public/gambar');
                $namaGambar = $file->getName();
            }

            $artikel = new ArtikelModel();
            // Pastikan slug unik
            $slug = url_title($this->request->getPost('judul'), '-', true);

            // Insert data artikel
            $artikel->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'slug'        => $slug,
                'gambar'      => $namaGambar,
                'status'      => $this->request->getPost('status')
            ]);
            return redirect()->to('/admin/artikel');
        }

        $title = "Tambah Artikel";
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();
        return view('artikel/form_add', compact('title', 'kategori'));
    }

    // Mengedit artikel
    public function edit($id)
    {
        $artikel = new ArtikelModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'id_kategori' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $dataUpdate = [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'status' => $this->request->getPost('status'),

            ];

            $file = $this->request->getFile('gambar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $file->move(ROOTPATH . 'public/gambar');
                $dataUpdate['gambar'] = $file->getName();
            }

            // Update artikel
            $artikel->update($id, $dataUpdate);
            return redirect()->to('/admin/artikel');
        }

        // Ambil data artikel untuk diedit
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();

        return view('artikel/form_edit', compact('title', 'data', 'kategori'));
    }

    // Menghapus artikel
    public function delete($id)
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect()->to('/admin/artikel');
    }

    public function kategori($id_kategori)
{
    $artikelModel = new \App\Models\ArtikelModel();
    $kategoriModel = new \App\Models\KategoriModel();

    $kategori = $kategoriModel->find($id_kategori);
    if (!$kategori) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kategori tidak ditemukan");
    }

    $artikel = $artikelModel->getArtikelDenganKategori($id_kategori);

    $data = [
        'judul' => 'Kategori: ' . $kategori['nama_kategori'],
        'artikel' => $artikel,
        'kategori' => $kategoriModel->findAll(),
        'current_category' => $id_kategori // Tambahkan ini
    ];

    return view('artikel/index', $data);
}




}