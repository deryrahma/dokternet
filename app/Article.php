<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = [
    	'article_category_id',
    	'title',
    	'description',
    	'image',
    ];

    public function article_category() {
    	return $this->belongsTo( 'App\ArticleCategory' );
    }
}
