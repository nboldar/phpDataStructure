<?php

class Chapter
{

    protected $title;

    protected $content;
    
    

    function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return mixed                         
     */
    public function getContent()
    {
        return $this->content;
    }

}


class Book implements IteratorAggregate{  
    protected $title;
    protected $author;
    protected $chapters;
    
    function  __construct($title,$author){
        $this->title = $title;
        $this->author = $author;
        $this->chapters=[];
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    function addChapter(Chapter $chapter){
        $this->chapters[] = $chapter;
    }
    
    function  getIterator() {
        return new ArrayIterator($this->chapters);
    }
    
}

$book = new Book("Книга про итераторы","Иванов И.И.");
$book->addChapter(new Chapter("Глава 1","Что такое итераторы"));
$book->addChapter(new Chapter("Глава 2","Что такое \"daemon\""));
$book->addChapter(new Chapter("Глава 3","Что такое итераторы-2"));

echo "Все главы книги ".$book->getTitle()." от автора ".$book->getAuthor().":";

foreach ($book as $chapter){
    echo $chapter->getTitle(). PHP_EOL;    
}





































