<?php
class wtConference
{

    public $members = [];

    public function __construct()
    {

        $this->setDB();

    }

    private function setDB()
    {
        $db = new wtcDB();
        $db();
    }

    public function entryNewMember($firstName, $lastName, $email, $firma)
    {
        $entry = new MemberEntry(htmlspecialchars($firstName) , htmlspecialchars($lastName) , htmlspecialchars($email) , htmlspecialchars($firma));
        $entry->save();
    }

    public function getMembers()
    {
        $membersList = new MembersList();
        $membersList->getMembers();
        $this->members = $membersList->members;

    }

    public function getCountMembers()
    {

        return count($this->members);

    }

    public function isLogin():
        bool
        {

            return isset($_SESSION['login']);
        }

        public function login($user, $password):
            bool
            {

                $isOk = false;

                if (!$this->isLogin())
                {
                    $user = new User(htmlspecialchars($user) , htmlspecialchars($password));
                    $user->verifyPassword();

                    if ($user->login)
                    {

                        $_SESSION['login'] = $user->user;
                        $isOk = true;

                    }

                }

                return $isOk;

            }

            public function logout()
            {

                if ($this->isLogin()) unset($_SESSION['login']);

            }

        }
?>
