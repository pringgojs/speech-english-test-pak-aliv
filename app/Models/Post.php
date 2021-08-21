<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function scopeSearch($q)
    {
        $search = \Input::get('search');
        if ($search) {
            $q->where('title', 'like', '%'.$search.'%');
        }

    }

    public function desc($max_text = 250)
    {
        $content = strip_tags($this->content);
        if (strlen($content) > $max_text) {
            return substr($content, 0, $max_text) .'...';
        }

        return $content;
    }

    public function generateLink()
    {
        $link = str_replace(' ', '-',  strtolower($this->title));
        $link = str_replace('/', '-', $link);
        $link = str_replace('.', '', $link);
        $link = str_replace('"', '', $link);

        return url('front/news/'. $this->id . '/' . $link);
    }
}
