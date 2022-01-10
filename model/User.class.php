<?php

class User
{
    public $login = false;
    public $user = null;
    private $password = null;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function verifyPassword()
    {
        $db = Connection::getInstance()->dbc;

        try
        {
            $stmt = $db->prepare("SELECT * FROM users WHERE userLogin=?");
            $stmt->execute([$this->user]);
            $user = $stmt->fetch();
        }
        catch(PDOException $e)
        {
            echo 'Query error.';
            die();
        }

        if (is_array($user))
        {
            if (password_verify($this->password, $user['userPassword']))
            {
                $this->login = true;
            }

            if (password_needs_rehash($this->password, PASSWORD_DEFAULT))
            {

                $hash = password_hash($this->password, PASSWORD_DEFAULT);

                try
                {
                    $db->beginTransaction();
                    $sql = "UPDATE users SET userPassword=? WHERE userLogin=?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$hash, $this->user]);
                    $db->commit();
                }
                catch(PDOException $e)
                {
                    $db->rollBack();
                    echo 'Error: ' . $e->getMessage();
                }
            }
        }

        $db = null;
    }
}

?>
