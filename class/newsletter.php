<?php
namespace db;
require_once 'dataBase.php';

class newsletter extends dataBase
{

    public function addNewsletter()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            // MailChimp API credentials
            $apiKey = 'ddbe70fbd62cddd622a54d95a6dd26eb-us1';
            $listID = 'b0e4d89128';

            // MailChimp API URL
            $memberID = md5(strtolower($email));
            $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
            $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

            // member information
            $json = json_encode([
                'email_address' => $email,
                'status'        => 'subscribed',
                'merge_fields'  => [
                    'FNAME'     => $fname,
                    'LNAME'     => $lname
                ]
            ]);

            // send a HTTP POST request with curl
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // store the status message based on response code
            if ($httpCode == 200) {
                echo '<p style="color: #34A853">Vous avez bien été inscris à la Newsletter de Zoro! </p>';
            } else {
                switch ($httpCode) {
                    case 214:
                        echo 'Vous êtes déjà inscris à la newsletter';
                        break;
                    default:
                        echo 'Nous avons recontré un problème réésayez ultérieurement';
                        break;
                }
//                $_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
            }
        }else{
            $_SESSION['msg'] = '<p style="color: #EA4335">Please enter valid email address.</p>';
        }
    }


}


?>