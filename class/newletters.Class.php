<?php
namespace db;
require_once 'dataBase.php';

class newletter extends dataBase
{
    public function insertnewsletter($email)
    {
        $insert = $this->query('INSERT INTO newletters (email) VALUE(?)', [$email]);
    }
    public function selectnewletter($email)
    {
        $select = $this->query("SELECT * FROM newletters WHERE email = '$email'");
        return $select->fetch();

    }

    public function newsletter($email)
    {
            if ($email != "")
            {
                $email = filter_var($email , FILTER_SANITIZE_EMAIL);

                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    echo $result = "The mail you entered is not a valid email address.";
                }
                else
                {
                    if ($this->selectnewletter($email) == true)
                    {
                        echo $result = "Your email is alredy registered.";
                    }
                    else
                    {
                        if ($this->insertnewsletter($email))
                        {
                            echo $result = "Your email has been successfully registered. Thanks for your interest in SABF.!";
                        }
                    }
                }
            }
            else
            {
                echo $result = 'Please enter your email address.';
            }
    }


}


?>