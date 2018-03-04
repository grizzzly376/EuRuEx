<?php

namespace AppBundle\Helper;

abstract class exchangeRes{
	abstract public function loadVal();
	protected $main_href;
	protected $res_href;
	protected $src_name;
	public function __construct(){
		
	}
	public function getJSON(){
		$val = $this->loadVal();
		if($val == false){
			return false;
		}
		return json_encode(["val" => $this->loadVal(),
							"main_href" => $this->main_href,
							"res_href" => $this->res_href,
							"src_name" => $this->src_name,
							"upd_datetime" => date("d.m.y H:i:s")]);
	}
}