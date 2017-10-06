<?php

$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$user = 'testdb';
$password = 'password';

$db = new \PDO($dsn, $user, $password);
$mapper = new Mapper($db);
$mapper->find();

class Mapper
{
    protected $db;
    protected $parts;

	public function __construct(\PDO $db)
	{
	    $this->db = $db;
            $this->parts['select'] = '';
            $this->parts['from'] = '';
            $this->parts['groupBy'] = '';
            $this->parts['having'] = '';
            $this->parts['orderBy'] = '';
	}

    public function __set($property, $value)
    {
        if (array_key_exists($property, $this->parts)) {
            $this->parts[$property] = $value;
        }
	
    }

	public function find(array $params =[])
	{
	    $this->select = "SELECT *";
	    $this->from = "FROM table";
	    $this->where = $this->buildWhere("WHERE field1 = 'OK'");
	    $this->orderBy = "ORDER BY field2";
var_dump($this->parts);
	    var_dump($this->buildSql());
	}

	protected function buildSql()
	{
	    return implode(' ', array_filter($this->parts));
	}
        protected function buildWhere($where)
        {
            return $where;
        }
}
