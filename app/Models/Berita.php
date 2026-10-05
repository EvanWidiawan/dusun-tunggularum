<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'gambar',
        'kategori',
        'penulis',
        'tanggal',
        'is_published',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
        'is_published' => 'boolean',
    ];

    /**
     * Daftar kategori bawaan yang disarankan di form admin.
     */
    public const KATEGORI = [
        'Pengumuman',
        'Kegiatan',
        'Pembangunan',
        'Kesehatan',
        'Pertanian',
        'Pendidikan',
        'Umum',
    ];

    protected static function booted(): void
    {
        // Slug otomatis & unik setiap kali judul dibuat / diubah
        static::saving(function (Berita $berita) {
            if (empty($berita->slug) || $berita->isDirty('judul')) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
            }

            // Ringkasan otomatis dari isi jika dikosongkan
            if (empty($berita->ringkasan) && !empty($berita->isi)) {
                $berita->ringkasan = Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($berita->isi))), 220);
            }

            if (empty($berita->penulis)) {
                $berita->penulis = 'Admin Dusun';
            }
        });
    }

    public static function generateUniqueSlug(string $judul, ?int $ignoreId = null): string
    {
        $base = Str::slug($judul) ?: 'berita';
        $slug = $base;
        $i = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Hanya berita berstatus terbit.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Urutan default: terbaru di atas.
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderBy('tanggal', 'desc')->orderBy('id', 'desc');
    }
}
