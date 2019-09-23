<?PHP
include_once ("_dbConn.php");
class DBCon
{

    private $dbhost;
    private $dbuser;
    private $dbpwd;
    private $dbname;

    private $pdo;

    function __construct($dbhost = DB_HOST, $dbuser = DB_USER, $dbpwd = DB_PASSWORD, $dbname = DB_NAME)
    {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpwd = $dbpwd;
        $this->dbname = $dbname;
    }

    private function setDBCon()
    {
        $charset = 'utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try
        {
            $this->pdo = new PDO("mysql:dbname=$this->dbname;host=$this->dbhost;charset=$charset", $this->dbuser, $this->dbpwd, $options);
        }
        catch (PDOException $th)
        {
            echo $th;
            exit;
        }
        //return $this->pdo;
    }

    public function getPDO()
    {
        $this->setDBCon();
        return $this->pdo;
    }

    public function getHostSettings()
    {
        echo $this->dbhost . "<br>";
        echo $this->dbuser . "<br>";
        echo $this->dbpwd . "<br>";
        echo $this->dbname . "<br>";
    }
}