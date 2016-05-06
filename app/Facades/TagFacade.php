<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class TagFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'TagRepository';
	}
}