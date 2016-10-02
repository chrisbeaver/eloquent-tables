<?php
namespace App\Table;

use Illuminate\Database\Eloquent\Builder;
use Request;

class TableBuilder extends Builder 
{
	public $eloquentBuilder;
	public $skip;
	public $take;
	public $search;
	public $page;
	
	public function __construct(Builder $builder)
	{
		$this->eloquentBuilder = $builder;
		// Had to pass through header, request() was coming back as string.
		$this->skip = Request::header('skip', 0);
		$this->take = Request::header('take', 10);
		$this->search = Request::header('search', '');

	}

	public static function makeTable(Builder $builder)
	{
		$table = new static($builder);
		// return $table->request;
		$count = $table->eloquentBuilder->count();

		$table = $table->eloquentBuilder
		      		   ->skip($table->skip)
			  		   ->take($table->take);

		// if ($this->search)
		// {	
		// 	->orWhere('name', 'like', '%' . Input::get('name') . '%')
		// }
		$payload = new \stdClass;
		$payload->data = $table->get();
		$payload->count = $count;
		return response()->json($payload);
	}

}