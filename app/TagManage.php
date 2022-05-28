<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagManage extends Model
{
    public function GalleryTag()
    {
        return $this->hasMany(TagGallery::class, 'tag_id', 'id');
    }
}
