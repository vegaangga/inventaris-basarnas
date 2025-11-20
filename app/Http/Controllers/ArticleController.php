<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use App\Models\Articles;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    // Publik: index + show
    public function index(Request $request) {
            $q = $request->get('q');

            $barangCount = Barang::count();

            $stokBarangs = Barang::select('nama_barang','stok','stok_minimum','satuan_id')
                ->with('satuan:id,satuan')
                ->orderBy('nama_barang')
                ->paginate(5)
                ->withQueryString();

            // 3 artikel terbaru saja untuk beranda
            $articles = Articles::when($q, function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%");
                })
                ->latest()      // sama dengan orderBy('created_at','desc')
                ->take(3)       // atau ->limit(3)
                ->get();

            return view('article.index', compact('articles','q', 'barangCount', 'stokBarangs'));
        }


    public function list(Request $request) {
        $q = $request->get('q');
        $articles = Articles::when($q, fn($w)=>$w->where('name','like',"%$q%"))
            ->orderBy('name')->paginate(12)->withQueryString();
        return view('article.list', compact('articles','q'));
    }

    public function show(Articles $article) {
        return view('article.show', compact('article'));
    }

    // Admin: create/store/edit/update/destroy
    public function create() {
        return view('article.form', ['article' => new Articles()]);
    }

    public function store(ArticleRequest $request) {
        $data = $request->validated();
        // handle upload
        if ($request->hasFile('image')) {
            // simpan ke public/images/articles
            $path = $request->file('image')->store('images/articles', 'public');
            $data['image_path'] = 'storage/'.$path; // asset('storage/...') aktifkan php artisan storage:link
        }
        // pastikan slug unik
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['slug'] = $this->uniqueSlug($data['slug']);

        $article = Articles::create($data);
        return redirect()->route('article.show', $article)->with('ok','Artikel dibuat.');
    }

    public function edit(Articles $article) {
        return view('article.form', compact('article'));
    }

    public function update(ArticleRequest $request, Articles $article) {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // hapus lama (opsional)
            if ($article->image_path && str_starts_with($article->image_path,'storage/')) {
                $old = Str::after($article->image_path, 'storage/');
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('image')->store('images/articles', 'public');
            $data['image_path'] = 'storage/'.$path;
        }

        // slug boleh diedit – pastikan unik
        if (!blank($data['slug']) && $data['slug'] !== $article->slug) {
            $data['slug'] = $this->uniqueSlug(Str::slug($data['slug']));
        }

        $article->update($data);
        return redirect()->route('article.show', $article)->with('ok','Artikel diperbarui.');
    }

    public function destroy(Articles $article) {
        if ($article->image_path && str_starts_with($article->image_path,'storage/')) {
            $old = Str::after($article->image_path, 'storage/');
            Storage::disk('public')->delete($old);
        }
        $article->delete();
        return redirect()->route('article.index')->with('ok','Artikel dihapus.');
    }

    private function uniqueSlug(string $base): string {
        $slug = $base; $i = 1;
        while (Articles::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }
        return $slug;
    }
}

