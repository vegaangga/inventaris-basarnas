<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Articles;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        
        Articles::create([
            'name' => 'Ring Buoy',
            'slug' => 'ring-buoy',
            'image_path' => 'https://upload.wikimedia.org/wikipedia/commons/5/58/Lifebuoy_with_reflective_tape.jpg',

            'bagian_utama' => <<<EOT
- Cincin pelampung berbentuk donat yang terbuat dari bahan busa padat atau plastik tahan air.
- Tali pengaman mengelilingi cincin untuk pegangan korban.
- Warna oranye terang untuk visibilitas tinggi di air.
EOT,

            'safety' => <<<EOT
1. Periksa kondisi fisik pelampung sebelum digunakan.
2. Pastikan tali pengaman tidak kusut atau rusak.
3. Jangan gunakan ring buoy sebagai mainan di area perairan.
4. Simpan jauh dari sumber panas yang dapat merusak bahan busa.
EOT,

            'operasional' => <<<EOT
1. Saat terjadi kecelakaan di perairan, lempar ring buoy ke arah korban dengan memperhitungkan arah angin dan arus.
2. Pastikan ring buoy dilempar sejauh mungkin agar tali dapat ditarik kembali jika meleset.
3. Setelah korban memegang ring buoy, tarik perlahan ke arah perahu atau tepi pantai.
EOT,

            'troubleshooting' => <<<EOT
- **Masalah:** Ring buoy tenggelam sebagian.
  **Solusi:** Periksa apakah ada retakan atau air masuk ke dalam busa.
- **Masalah:** Tali mudah lepas.
  **Solusi:** Ganti tali dengan bahan nilon tahan air dan ikat kuat di setiap ujung.
EOT,

            'penyimpanan' => <<<EOT
- Gantung ring buoy di tempat kering dan teduh setelah digunakan.
- Hindari paparan sinar matahari langsung dalam waktu lama.
- Bersihkan dengan air tawar untuk menghindari kerusakan akibat garam laut.
EOT,
        ]);
    }
}
