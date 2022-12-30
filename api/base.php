<?php
session_start(); //啟動session功能
date_default_timezone_set("Asia/Taipei"); //設定亞洲台北時間

class DB
{ //物件導向
    protected  $dsn = "mysql:host=localhost;charset=utf8;dbname=db04";
    protected $table;
    protected $pdo;

    public function __construct($table) //底線要兩個  __construct建構子
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }
    public function find($id)
    {
        $sql = "select * from $this->table ";
        if (is_array($id)) {

            $tmp = $this->arrayTosqlArray($id);

            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`='$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function all(...$arg)
    { //...$arg不定參數
        $sql = "select * from $this->table ";
        if (isset($arg[0])) {

            if (is_array($arg[0])) {

                $tmp = $this->arrayToSqlArray($arg[0]);

                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[0];
            }
        }
        if (isset($arg[1])) { //如果$arg[1]存在的話
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save($array)
    {
        if (isset($array['id'])) {
            $id = $array['id'];//更新
            unset($array['id']);
            $tmp = $this->arrayToSqlArray($array);
            $sql = "update $this->table set " . join(",", $tmp) . " where `id`='$id'";
        } else {
            $cols = array_keys($array); //新增
            $sql = "insert into $this->table (`" . join("`,`", $cols) . "`) value('" . join("','", $array) . "')";
            //INSERT INTO `bottom`(`id`, `bottom`) VALUES ('[value-1]','[value-2]') sql語法
        }
        echo $sql;
        $this->pdo->exec($sql);
    }
    public function del($id)
    {
        $sql = "delete  from $this->table ";
        if (is_array($id)) {

            $tmp = $this->arrayTosqlArray($id);

            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }


    public function count(...$arg){
        return $this->math('count',...$arg);
    }
    public function sum($col,...$arg)//...為不定參數
    {
return $this ->math('sum',$col,...$arg);//...為解構賦值
    }
    public function max($col,...$arg)
    {
        return $this ->math('max',$col,...$arg);
    }
    public function min($col,...$arg)
    {
        return $this ->math('min',$col,...$arg);
    }
    public function avg($col,...$arg)
    {
        return $this ->math('avg',$col,...$arg);
    }

    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }
    private function math($math,...$arg){
        switch($math){
            case 'count':
            $sql="select count(*) from $this->table";
            if(isset($arg[0])){
                $con=$arg[0];
            }
            break;
            default;
            $col=$arg[0];
            if(isset($arg[1])){
                $con=$arg[1];
            }
            $sql="select $math($col) from $this->table";
        }
        if(isset($con)){
            if(is_array($con)){

                $tmp=$this->arrayToSqlArray(($con));
                $sql=$sql . " where " . join(" && ",$tmp);
            }else{
                $sql=$sql . $con;
            }
        }
        return $this->pdo->query($sql)->fetchColumn();
    }
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";   
}
function to($url)
{
    header("location:" . $url); //header把頁面轉到 主機的location
}
function q($sql) //跟資料庫連線的function
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=db04";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
$Bottom=new DB('bottom');
$Title=new DB('title');
$Ad=new DB('ad');
$Mvim=new DB('mvim');
$Image=new DB('image');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');
$Total=new DB('total');

if(!isset($_SESSION['visit'])){ //判斷session是否存在
    //如果不存在的話執行以下
$_SESSION['visit']=1;
$total=$Total->find(1);
$total['total']++;
$Total->save($total);
}




$db = new DB('bottom');




//沒有顯示在畫面的功能可以不要? >
