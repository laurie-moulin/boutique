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
                    echo $result = "Le mail que vous avez entré n'est pas valide.";
                }
                else
                {
                    if ($this->selectnewletter($email) == true)
                    {
                        echo $result = "Votre mail est déjà enregistré.";
                    }
                    else
                    {
                        if ($this->insertnewsletter($email))
                        {
                            echo $result = "Votre mail a été enregistré ! . Merci pour votre intérêt .!";
                        }
                    }
                }
            }
            else
            {
                echo $result = 'Veuillez entrer votre adresse mail .';
            }
    }


}


?>