<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use \App\Models\Item;
use APILIB\Auth\Authorisation as auth;

class ItemEANExists extends AbstractRule
{

	private $id;

	public function __construct($id=0)
	{

		$this->id = $id;
	}

	public function validate($input)
	{

		$ItemModel=new \App\Models\Item();

		return !$ItemModel->where(['ean'=>$input])->where('id', '!=', $this->id)->count();


	}
}
