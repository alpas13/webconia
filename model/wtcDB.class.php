<?php
class wtcDB extends DB
{
    const DB_TABLE_USERS_NAME = "users";
    const DB_TABLE_MEMBERS_NAME = "members";

    private $dbc;
    private $connectionString = self::DB_driver . ':host=' . self::DB_host . ';dbname=' . self::DB_name;
    private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    public function __construct()
    {
    }

    public function __invoke()
    {
        $this->createDB();
        $this->setDB();
    }

    private function createDB()
    {
        try
        {
            $db = new PDO(self::DB_driver . ':host=' . self::DB_host, self::DB_user, self::DB_password, $this->options);
            $sql = "CREATE DATABASE IF NOT EXISTS " . self::DB_name;
            $db->exec($sql);
        }
        catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        $db = null;
    }

    private function setDB()
    {
        try
        {
            $this->dbc = new PDO($this->connectionString, self::DB_user, self::DB_password, $this->options);
            $this->setDatabaseTables();
            $this->insertUsers();
        }
        catch(PDOException $e)
        {
            die('Error: ' . $e->getMessage());
        }

        $this->dbc = null;
    }

    private function setDatabaseTables()
    {
        try
        {
            $sql = 'CREATE TABLE IF NOT EXISTS ' . self::DB_TABLE_USERS_NAME . ' (
                    id INTEGER PRIMARY KEY,
                    userLogin VARCHAR(50),
                    userPassword VARCHAR(255),
                    userRole VARCHAR(50),
                    createDate TIMESTAMP
                )';

            $db = $this
                ->dbc
                ->prepare($sql);
            $db->execute();

            $sql = 'CREATE TABLE IF NOT EXISTS ' . self::DB_TABLE_MEMBERS_NAME . ' (
                    id INTEGER AUTO_INCREMENT PRIMARY KEY,
                    firstName VARCHAR(250),
                    lastName VARCHAR(250),
                    email VARCHAR(250) UNIQUE,
                    firma VARCHAR(250),
                    entryDate TIMESTAMP
                )';

            $db = $this
                ->dbc
                ->prepare($sql);
            $db->execute();
        }
        catch(PDOException $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function insertUsers()
    {
        try
        {
            $sql = "SELECT COUNT(*) AS num FROM `users` WHERE userLogin = :login";
            $stmt = $this
                ->dbc
                ->prepare($sql);;
            $stmt->bindValue(':login', 'user');
            $stmt->execute();
            $row = $stmt->fetch();
        }
        catch(PDOException $e)
        {
        }

        if ($row['num'] < 1)
        {
            $hash = password_hash('user', PASSWORD_DEFAULT);

            try
            {
                $sql = "INSERT INTO users (
                        id,
                        userLogin, 
                        userPassword,
                        userRole,
                        createDate)
                    VALUES (1, 'user', '$hash', 'user', now())";

                $db = $this
                    ->dbc
                    ->prepare($sql);
                $db->execute();
            }
            catch(PDOException $e)
            {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
