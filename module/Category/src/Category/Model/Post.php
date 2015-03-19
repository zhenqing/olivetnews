<?php
namespace Category\Model;

class Post {
	const STATUS_PUBLISHED = 1;
	const STATUS_PENDING = 0;
	
	protected  $id;
	protected  $title;
	protected  $content;
	protected $author;
	protected $status;
	protected $create_time;
	protected $imageurl;
	protected $category;
	protected $categoryService;
	

	public function __construct(CategoryTable $categoryService=null){
		$this->categoryService = $categoryService;
	}
	public function setCategoryService(CategoryTable $categoryService){
		$this->categoryService = $categoryService;
	}

	public function exchangeArray($data)
	{
		
		$this->id = $data['id'];
		$this->title = $data['title'];
		$this->content = $data['content'];
		$this->author = $data['author'];
		$this->create_time = $data['create_time'];
		$this->imageurl = $data['imageurl'];
		$this->status = $data['status'];
		if($this->categoryService){
			$this->category = $this->categoryService->getById($data['category_id']);
		}
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getContent(){
		return $this->content;
	}
	
	public function getAuthor(){
		return $this->author;
	}
	
	
	public function getCreate_time(){
		return $this->create_time;
	}
	public function getImageurl(){
		return $this->imageurl;
	}
	public function getStatus(){
		return $this->status;
	}
	public function getReadableStatus(){
		return $this->status==self::STATUS_PUBLISHED ? "Published":"Pending";
	}
	
	public function getCategoryName(){
		return $this->category->getName();
	}
	public function getExcerpt(){
		return $this->trim_text($this->content,300);
	}
	public function trim_text($input, $length, $ellipses = true)
{
    if (strlen($input) <= $length) {
        return $input;
    }

    // find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    if ($last_space === FALSE) {
        $last_space = $length;
    }

    $trimmed_text = substr($input, 0, $last_space);

    // add ellipses
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}
}
	