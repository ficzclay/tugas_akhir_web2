<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class AjaxController extends Controller
{
    public function index()
    {
        return view('ajax/index');
    }

    public function getData()
    {
        $artikelModel = new ArtikelModel();
        $kategori = $this->request->getGet('kategori');
        $page = $this->request->getGet('page') ?? 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $builder = $artikelModel->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

        if (!empty($kategori)) {
            $builder->where('kategori.nama_kategori', $kategori);
        }

        $total = $builder->countAllResults(false);
        $data = $builder->findAll($limit, $offset);

        return $this->response->setJSON([
            'data' => $data,
            'totalPages' => ceil($total / $limit),
            'currentPage' => (int)$page
        ]);
    }

    public function save()
    {
        $artikelModel = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $namaKategori = $this->request->getPost('kategori');
        $kategori = $kategoriModel->where('nama_kategori', $namaKategori)->first();

        if (!$kategori) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kategori tidak ditemukan']);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'id_kategori' => $kategori['id_kategori'],
            'status' => $this->request->getPost('status')
        ];

        $artikelModel->insert($data);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function edit($id)
    {
        $artikelModel = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $namaKategori = $this->request->getPost('kategori');
        $kategori = $kategoriModel->where('nama_kategori', $namaKategori)->first();

        if (!$kategori) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kategori tidak ditemukan']);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'id_kategori' => $kategori['id_kategori'],
            'status' => $this->request->getPost('status')
        ];

        $artikelModel->update($id, $data);

        return $this->response->setJSON(['status' => 'updated']);
    }

    public function delete($id)
    {
        $artikelModel = new ArtikelModel();
        $artikelModel->delete($id);

        return $this->response->setJSON(['status' => 'deleted']);
    }
}