public function max($col,...$arg){
        return $this->math('max',$col,...$arg); //...為解構賦值
    }
    public function min($col,...$arg){
        return $this->math('min',$col,...$arg); //...為解構賦值
    }
    public function avg($col,...$arg){
        return $this->math('avg',$col,...$arg); //...為解構賦值
    }
    private function arrayToSqlArray($array){
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }
    private function math($math,...$arg){
        switch($math){
            case 'count':
                $sql="select count(*) from $this->table ";
                if(isset($arg[0])){
                    $con=$arg[0]; 
                }
            break;
            default:
                $col=$arg[0];
                if(isset($arg[1])){
                    $con=$arg[1];
                }
                $sql="select $math($col) from $this->table ";

        }

        if(isset($con)){
            if(is_array($con)){
                $tmp=$this->arrayToSqlArray($con);
                $sql=$sql . " where " .  join(" && ",$tmp);
            }else{
                $sql=$sql . $con;
            }
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }
}
function dd($array){
echo "<pre>";
print_r($array);
echo "</pre>";
}
function to($url){
    header("location".$url);
}
function q($sql){
    $dsn="mysql:host=localhost;charset=utf8;dbname=db04";
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);