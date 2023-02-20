<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['category_id', 'name', 'description'];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithFilters($query, $category, $name)
    {
        return $query->when(!empty($category), function ($query) use ($category) {
            $query->where('category_id', $category);
        })
            ->when(!empty($name), function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            });
    }
}
