<?php
class MemberEntry
{
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $firma = '';

    public function __construct($firstName, $lastName, $email, $firma)
    {

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->firma = $firma;
    }

    public function save()
    {
        $db = Connection::getInstance()->dbc;

        $sql = "INSERT INTO members (
			firstName,
            lastName,
            email,
            firma,
            entryDate)
			VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->firma',  now())";

        try
        {
            $db->beginTransaction();
            $db->exec($sql);
            $db->commit();
        }
        catch(PDOException $e)
        {
            $db->rollBack();
        }

        $db = null;
    }

}
?>
