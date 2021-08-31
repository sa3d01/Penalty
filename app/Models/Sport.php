<?php

namespace App\Models;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Sport extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['name', 'banned','logo'];
    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    protected function getLogoAttribute()
    {
        $file = $this->getMedia("sports")->first();
        if ($file) {
            return $this->getMedia("sports")->first()->getFullUrl('thumb');
        }
        return asset('media/images/default.png');
    }

    protected function setLogoAttribute($image)
    {
        FileService::upload($image, $this, "sports", true);
    }
}
