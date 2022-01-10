<?php
class Connection extends DB
{

    public $dbc;
    private static $instance;
    private $connectionString = self::DB_driver . ':host=' . self::DB_host . ';dbname=' . self::DB_name;

    function __construct()
    {
        $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try
        {
            $this->dbc = new PDO($this->connectionString, self::DB_user, self::DB_password, $options);
        }
        catch(PDOException $e)
        {
            die('Error: ' . $e->getMessage());
        }

    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}
?>
