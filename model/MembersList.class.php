<?php
class MembersList
{
    public $members = [];

    function __construct()
    {
    }

    public function getMembers()
    {
        $db = Connection::getInstance()->dbc;

        $sql = "SELECT * FROM members ORDER BY id ASC";

        $res = $db->query($sql);

        foreach ($res as $row)
        {
            array_push($this->members, $row);
        }

        $db = null;
    }
}

?>
