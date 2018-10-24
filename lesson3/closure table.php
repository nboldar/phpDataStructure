<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 24.10.2018
 * Time: 23:33
 */


    //  database
    mysql_connect('localhost', 'root', '');
    mysql_select_db('test');

    echo '<pre>';

    $categories = Category::getTopCategories();
    print_r($categories);

    echo '</pre>';

class Category
{

    public $id;
    public $parent;
    public $name;


    public $children;

    public function __construct()
    {

        $this->getChildCategories();
    }


    public function getChildCategories()
    {
        if ($this->children) {
            return $this->children;
        }
        return $this->children = self::getCategories("parent = {$this->id}");
    }

    ////////////////////////////////////////////////////////////////////////////

    public static function getTopCategories()
    {
        return self::getCategories('parent = 0');
    }

    public static function getCategories($where = '')
    {
        if ($where) $where = " WHERE $where";
        $result = mysql_query("SELECT * FROM categories {$where}");

        $categories = array();
        while ($category = mysql_fetch_object($result, 'Category'))
            $categories[] = $category;

        mysql_free_result($result);
        return $categories;
    }
}