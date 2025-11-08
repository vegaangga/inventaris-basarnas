<?php
// app/Models/Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Articles extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'name','slug','image_path','bagian_utama','safety','operasional','troubleshooting','penyimpanan'
    ];

    // Route model binding pakai slug
    public function getRouteKeyName(): string {
        return 'slug';
    }

    // Auto-set slug jika kosong
    protected static function booted(): void {
        static::saving(function ($article) {
            if (blank($article->slug)) {
                $article->slug = Str::slug($article->name);
            }
        });
    }

    // Helper URL gambar (fallback)
    public function imageUrl(): string {
        if ($this->image_path && str_starts_with($this->image_path, 'http')) return $this->image_path;
        return $this->image_path ? asset($this->image_path) : asset('images/placeholder.jpg');
    }
}
