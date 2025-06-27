<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'artikel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['judul', 'isi', 'status', 'slug', 'gambar', 'id_kategori'];

    /**
     * Ambil semua artikel dengan join ke nama_kategori
     */
    public function getArtikelDenganKategori($id_kategori = null)
    {
        $builder = $this->select('artikel.*, kategori.nama_kategori')
                        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

        if ($id_kategori !== null) {
            $builder->where('artikel.id_kategori', $id_kategori);
        }

        return $builder->findAll(); // hasil berupa array asosiatif
    }
    
}