<?php
namespace app\controllers;

use app\database\Connection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginController
{
    public function store(Request $request, Response $response)
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
    
        $connection = Connection::getConnection();
    
        $prepare = $connection->prepare("select id, firstName, email, password from users where email = :email");
    
        $prepare->execute([
            'email' => $email,
        ]);
    
        $user = $prepare->fetchObject();
    
        if (!$user) {
            http_response_code(401);
            die();
        }
        
        if (!password_verify($password, $user->password)) {
            http_response_code(401);
            die();
        }
    
        unset($user->password);
        $_SESSION['user'] = $user;
    
        http_response_code(200);
    
        echo json_encode('loggedIn');
    
        return $response;
    }
}
