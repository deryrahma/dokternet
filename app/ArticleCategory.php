<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_category';
    protected $fillable = [
    	'name',
    ];

    public function articles() {
    	return $this->hasMany( 'App\Article' );
    }
}
