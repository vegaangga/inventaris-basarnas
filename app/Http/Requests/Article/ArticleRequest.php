<?php
// app/Http/Requests/ArticleRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'name' => ['required','string','max:200'],
            'slug' => ['nullable','string','max:220'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'image_path' => ['nullable','string','max:500'], // jika pakai URL atau path manual
            'bagian_utama' => ['nullable','string'],
            'safety' => ['nullable','string'],
            'operasional' => ['nullable','string'],
            'troubleshooting' => ['nullable','string'],
            'penyimpanan' => ['nullable','string'],
        ];
    }
}
