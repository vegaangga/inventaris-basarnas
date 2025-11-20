<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManajemenArticleController extends Controller
{
    public function index()
    {
        return view('manajemen-article.index');
    }

    public function getData()
    {
        $articles = Articles::orderByDesc('updated_at')->get();

        return response()->json([
            'success' => true,
            'data'    => $articles,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'bagian_utama'   => 'nullable|string',
            'safety'         => 'nullable|string',
            'operasional'    => 'nullable|string',
            'troubleshooting'=> 'nullable|string',
            'penyimpanan'    => 'nullable|string',
            // 'image'          => 'nullable|image|max:2048', // upload file
            'image_url'      => 'nullable|url',            // URL internet
        ]);

        // pilih prioritas: file > url
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/articles', 'public');
            $data['image_path'] = 'storage/' . $path;
        } elseif (!empty($data['image_url'])) {
            $data['image_path'] = $data['image_url'];
        }

        unset($data['image_url']); // bukan kolom di DB

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['slug'] = $this->uniqueSlug($data['slug']);

        $article = Articles::create($data);

        return response()->json([
            'message' => 'Artikel berhasil ditambahkan.',
            'data'    => $article,
        ]);
    }

    public function show($id)
    {
        $article = Articles::findOrFail($id);

        return response()->json([
            'data' => $article,
        ]);
    }

    public function edit($id)
    {
        $article = Articles::findOrFail($id);

        return response()->json([
            'data' => $article,
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Articles::findOrFail($id);

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'bagian_utama'   => 'nullable|string',
            'safety'         => 'nullable|string',
            'operasional'    => 'nullable|string',
            'troubleshooting'=> 'nullable|string',
            'penyimpanan'    => 'nullable|string',
            // 'image'          => 'nullable|image|max:2048',
            'image_url'      => 'nullable|url',
        ]);

        // handle gambar
        if ($request->hasFile('image')) {
            // hapus file lama kalau memang file lokal
            if ($article->image_path && str_starts_with($article->image_path, 'storage/')) {
                $old = Str::after($article->image_path, 'storage/');
                Storage::disk('public')->delete($old);
            }

            $path = $request->file('image')->store('images/articles', 'public');
            $data['image_path'] = 'storage/' . $path;
        } elseif (!empty($data['image_url'])) {
            // kalau diisi URL baru → ganti image_path, tapi jangan hapus file lama kalau dulu URL juga
            if ($article->image_path && str_starts_with($article->image_path, 'storage/')) {
                $old = Str::after($article->image_path, 'storage/');
                Storage::disk('public')->delete($old);
            }
            $data['image_path'] = $data['image_url'];
        } else {
            // kalau URL dikosongkan & tidak upload file → jangan sentuh image_path
            unset($data['image_path']);
        }

        unset($data['image_url']);

        // slug
        if (!blank($data['slug']) && $data['slug'] !== $article->slug) {
            $data['slug'] = $this->uniqueSlug(Str::slug($data['slug']));
        } else {
            unset($data['slug']);
        }

        $article->update($data);

        return response()->json([
            'message' => 'Artikel berhasil diperbarui.',
            'data'    => $article,
        ]);
    }

    public function destroy($id)
    {
        $article = Articles::findOrFail($id);

        if ($article->image_path && str_starts_with($article->image_path, 'storage/')) {
            $old = Str::after($article->image_path, 'storage/');
            Storage::disk('public')->delete($old);
        }

        $article->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus.',
        ]);
    }

    private function uniqueSlug(string $base): string
    {
        $slug = $base;
        $i = 1;

        while (Articles::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
