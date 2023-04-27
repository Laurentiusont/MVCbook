<?php

namespace controller;

use dao\UserDao;

class UserController
{
    private UserDao $userDao;
    public function __construct()
    {
        $this->userDao=new UserDao();
    }
    public function index():void
    {
        $loginPressed = filter_input(INPUT_POST,'btnLogin');
        if(isset($loginPressed)){
            $email = filter_input(INPUT_POST,'email');
            $password = filter_input(INPUT_POST,'password');
            if(trim($email) == ''||trim($password) == ''){
                echo `
            <div class="text-center">
                Please input your email annd password!
            </div>
            `;
            }else{
                $user = $this->userDao->login($email, $password);
                /**  @var $user \entity\User */
                if(($user->getEmail()) == $email){
                    $_SESSION['registered_user'] = true;
                    $_SESSION['registered_name'] = $user->getName();
                    header('location:index.php');
                }else{
                    echo '
                    <div>
                        Invalid email or password
                    </div>
                ';
                }
            }
        }
        include_once 'pages/login.php';
    }
    public function logout():void
    {
        session_unset();
        session_destroy();
        header('location:index.php');
    }
}