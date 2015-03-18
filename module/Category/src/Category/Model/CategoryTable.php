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
		return $resultSet;
	}
}