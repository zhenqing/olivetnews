<?php 
namespace Category\Model;
use DomainException;
use InvalidArgumentException;
use Traversable;
use Zend\Stdlib\ArrayUtils;
use Category\Model\Post;
use Application\Model\TableAbstract;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
class PostTable{
	
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	function fetchAll($paginated=false) {
		if($paginated){
			$select = new Select('posts');
			  $resultSetPrototype = new ResultSet();

             $resultSetPrototype->setArrayObjectPrototype(new Post());
               $paginatorAdapter = new DbSelect(

                 // our configured select object

                 $select,

                 // the adapter to run it against

                 $this->tableGateway->getAdapter(),

                 // the result set to hydrate

                 $resultSetPrototype

             );

             $paginator = new Paginator($paginatorAdapter);

             return $paginator;
		}else{
			$select = $this->tableGateway->getSql()->select();
			$select->order('create_time desc');
			$select->limit(2);
			return $this->tableGateway->selectWith($select);
		}
		
	}
	
	
	function getPostsByCategoryId($categoryId,$paginated=false){
		if($paginated){
			$select = new Select('posts');
			if($categoryId != 0 ){
			$select->where(array(
				"category_id"=>$categoryId,
				//"id"=>$id
			));
		}
			  $resultSetPrototype = new ResultSet();

             $resultSetPrototype->setArrayObjectPrototype(new Post());
               $paginatorAdapter = new DbSelect(

                 // our configured select object

                 $select,

                 // the adapter to run it against

                 $this->tableGateway->getAdapter(),

                 // the result set to hydrate

                 $resultSetPrototype

             );

             $paginator = new Paginator($paginatorAdapter);

             return $paginator;
		}else{
			$select = $this->tableGateway->getSql()->select();
			$select->order('create_time desc');
			$select->limit(2);
			return $this->tableGateway->selectWith($select);
			$select = $this->tableGateway->getSql()->select();
		
		if($categoryId != 0 ){
			$select->where(array(
				"category_id"=>$categoryId,
				//"id"=>$id
			));
			
			
		}
		$select->order('category_id desc');
		$select->order('create_time desc');
		
		$select->limit(2);
		$select->offset(1);
		
		//echo $select->getSqlString();
		
		return $this->tableGateway->selectWith($select);
		}
		
	}
	function fetchById($id){
		// return $this->tableGateway->select();
		$select = $this->tableGateway->getSql()->select();
		$select->where->equalTo('id',$id);
		return $this->tableGateway->selectWith($select);
	}
	public function savePost(Post $post){
		
		$data = array(
			'title'=>$post->getTitle(),
			'content'=>$post->getContent(),
			'author'=>$post->getAuthor(),
			'category_name'=>$post->getCategoryName(),
			'create_time'=>now(),
			'imgurl'=>$post->getImgurl()
		);
		
		if ($post->getId()){
			$this->tableGateway->update($data,array("id"=>$post->getId()));
		}else{
			$this->tableGateway->insert($data);
			$id = $this->tableGateway->lastInsertValue;
			
			$post->setId($id);
		}
		
		return $post;
	}
	
}
