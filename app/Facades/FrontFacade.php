<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class FrontFacade extends Facade
{
	
	protected static function getFacadeAccessor(){
		return 'FrontRepository';
	}
}