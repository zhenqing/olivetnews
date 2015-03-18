<?php
namespace Category\Model;

class Category{
	protected $id;
	protected $name;
	protected $position;
	protected $imgurl;
	public function exchangeArray($data){
		$this->id=$data['id'];
		$this->name = $data['name'];
		$this->position = $data['position'];
		$this->imgurl = $data['imgurl'];
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getPosition(){
		return $this->position;
	}
	public function getImgurl(){
		return $this->imgurl;
	}
}