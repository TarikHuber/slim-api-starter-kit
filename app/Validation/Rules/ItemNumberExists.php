<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use \App\Models\Item;

class ItemNumberExists extends AbstractRule
{

	private $id;

	public function __construct($id=0)
	{
		$this->id = $id;
	}

	public function validate($input)
	{

		$ItemModel=new \App\Models\Item();
		return !$ItemModel->where(['number'=>$input])->where('id', '!=', $this->id)->count();

	}
}
