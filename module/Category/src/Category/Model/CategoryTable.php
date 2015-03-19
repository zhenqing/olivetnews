<?php
namespace Category\Model;
use DomainException;
use InvalidArgumentException;
use Traversable;
use Zend\Stdlib\ArrayUtils;
use Zend\Db\TableGateway\TableGateway;
use Category\Model\Category;	
use Application\Model\TableAbstract;
class CategoryTable{
	protected $tableGateway;
	function __construct(TableGateway $tableGateway){
		$this->tableGateway=$tableGateway;
	}
	 function fetchAll(){
		return $this->tableGateway->select();
	}

	 function getById($id){
		$sql = $this->tableGateway->getSql();
		$select = $sql->select();
		$select->where(array('id'=>$id));
		$resultSet = $this->tableGateway->selectWith($select);
		return $resultSet->current();
	}

	
	public function saveCategory(Category $category){
		
		$data = array(
			'name'=>$category->getName(),
			'position'=>$category->getPosition(),
			'imgurl'=>$category->getImgurl()
		);
		
		if ($category->getId()){
			$this->tableGateway->update($data,array("id"=>$category->getId()));
		}else{
			$this->tableGateway->insert($data);
			$id = $this->tableGateway->lastInsertValue;
			
			$category->setId($id);
		}
		
		return $category;
	}
	
	public function deleteCategory(Category $category){
		return $this->tableGateway->delete(array("id"=>$category->getId()));
	}
}