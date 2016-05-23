<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActionAttributeTrait;
class Article extends Model
{
	use ActionAttributeTrait;
	
    protected $table = 'articles';

    protected $fillable = ['category_id','title','intro','img','content_html','content_mark','status'];

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.article.action');
    }

    public function tag()
    {
    	return $this->belongsToMany('App\Models\Tag','article_tag','article_id','tag_id')->withTimestamps();
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
