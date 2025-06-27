<?php
namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini {
    public function render($kategori = null) {
        $model = new ArtikelModel();

        $builder = $model->select('artikel.*, kategori.nama_kategori')
                         ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                         ->orderBy('artikel.created_at', 'DESC')
                         ->limit(5);

        if ($kategori) {
            $builder->where('kategori.nama_kategori', $kategori);
        }

        $artikel = $builder->findAll();

        return view('components/artikel_terkini', ['artikel' => $artikel, 'kategori' => $kategori]);
    }
}