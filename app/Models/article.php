<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActionAttributeTrait;
class article extends Model
{
	use ActionAttributeTrait;
	
    protected $table = 'articles';

    private $action;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->action = config('admin.global.user.action');
    }
}
