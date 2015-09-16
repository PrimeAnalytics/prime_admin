<?php

namespace PRIME\Controllers;

use Phalcon\Tag as Tag;
use PRIME\Models\Users;
use PRIME\Models\Organisation;
use PRIME\Models\PhysicalAddress;
use PRIME\Models\OrgDatabase;


class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateAfter('login');
        Tag::setTitle('Sign In');
        parent::initialize();
    }

    public function indexAction()
    {
        
        
    }
    
        
    public function registerAction()
    {
        $request = $this->request;
        if ($request->isPost()) {
            
            $full_name = $request->getPost('firstname', array('string', 'striptags'))." ".$request->getPost('lastname', array('string', 'striptags'));
            
            $organisation_name = $request->getPost('organisation_name', array('string', 'striptags'));         
            
            $email = $request->getPost('email', 'email');
            
            $password = $request->getPost('password');
            
            $repeat_password = $this->request->getPost('password2');
            
            if($password!=$repeat_password)
            {
                
                $this->flash->error("Passwords don't match");
                return $this->forward('session/register');
            }
          
            $organisation =new Organisation();
            
            $organisation->name = $organisation_name;
            $organisation->theme = 'make';
            
            if ($organisation->save() == true) {

                $config = new \Phalcon\Config\Adapter\Ini('/../app/config/config.ini');

                $database = new OrgDatabase();

                $database->db_host = $config->database->host;
                $database->db_username = "admin_".$organisation_name;
                $database->db_password = sha1($password);
                $database->db_name = "db_".$organisation_name;
                $database->organisation_id = $organisation->id;

                $user = new Users();
                $user->password = sha1($password);
                $user->full_name = $full_name;
                $user->role ='Admin';
                $user->email = $email;
                $user->created_at = new \Phalcon\Db\RawValue('now()');
                $user->status = 'disable';
                $user->organisation_id = $organisation->id;
                
                if ($user->save() == false) {
                    foreach ($user->getMessages() as $message) {
                        $this->flash->error((string) $message);
                    }
                } 
                else if ($database->save() == false) {
                    foreach ($database->getMessages() as $message) {
                        $this->flash->error((string) $message);
                    }
                }
               else {
                    
                    //Read the configuration

                    $host= $config->database->host; 

                    $root=$config->database->username; 
                    $root_password=$config->database->password; 

                    $user= "admin_".$organisation_name;
                    $pass = sha1($password);
                    $db="db_".$organisation_name; 

                    try {
                        $dbh = new \PDO("mysql:host=$host", $root, $root_password);

                        $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
                        or die(print_r($dbh->errorInfo(), true));
                        
                    }
                    catch (PDOException $e) {
                        die("DB ERROR: ". $e->getMessage());
                    } 
                    
                    
                    Tag::setDefault('email', '');
                    Tag::setDefault('password', '');
                    $this->flash->success('Thanks for signing up for a new PRIME Dashboard, our consultants will contact you soon.');
                    return $this->forward('session/index');
                }
            }
            else
            {
                foreach ($organisation->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            }
        }
    }
    
    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($user)
    {
        
        $organisation= Organisation::findFirstById($user->organisation_id);
        
        $this->session->set('auth', array(
            'email' => $user->email,
            'role' =>$user->role,
            'full_name' => $user->full_name,
            'organisation_id' => $user->organisation_id,
            'theme' => $organisation->theme,
            'organisation_name' => $organisation->name
        ));
        
    }

    /**
     * This actions receive the input from the login form
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email', 'email');

            $password = $this->request->getPost('password');
            $password = sha1($password);

            $user = Users::findFirst("email='$email' AND password='$password'");
            if ($user != false) {
                
                if($user->status == 'enable' )
                {
                    $this->_registerSession($user);
                    

                        return $this->forward('index/'.$user->role);

                }
                else
                {
                    $this->flash->error('Your account is currently disabled');
                    return $this->forward('session/index');
                }
            }
            

            $this->flash->error('Wrong email/password');
        }

        return $this->forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('session/index');
    }
}
