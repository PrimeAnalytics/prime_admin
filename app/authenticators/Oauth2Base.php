<?php
namespace PRIME\Authenticators;
use \Phalcon\Db\Adapter\Pdo;
use \Phalcon\Mvc\Controller as Controller;
use PRIME\Models\Organisation;;
use PRIME\Models\DataConnector;

class Oauth2AuthenticatorBase extends Controller
{    
    public $authenticator_name = "";
    public $form_struct='';
    public $provider_name;
    public $authorizationHeader;
    
    public function GetTokenAction($data_connector_id)
    {
        $data_connector = DataConnector::findFirstByid($data_connector_id);
        $parameters=(array)json_decode($data_connector->parameters,true);

        if(array_key_exists ( 'auth' , $parameters))
        {  
            $provider = new $this->provider_name([
            'clientId'      => $parameters['auth']['client_id'],
            'clientSecret'  => $parameters['auth']['client_secret'],
            'redirectUri'   => "http://".$_SERVER['HTTP_HOST']."/Authenticators/".$this->dispatcher->getControllerName(),
            'scopes'        => $parameters['auth']['scope'],
            ]);
            
            $options= array();
            $options['state']=$data_connector_id;
            $options['approval_prompt']=force;

            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl($options);
            header('Location: '.$authUrl);
            exit;

        }
    }

    public function AuthenticateAction()
    {
        $data_connector = DataConnector::findFirstByid($_GET['state']);
        $parameters=(array)json_decode($data_connector->parameters,true);

        if(array_key_exists ( 'auth' , $parameters))
        {  
            $provider = new $this->provider_name([
            'clientId'      => $parameters['auth']['client_id'],
            'clientSecret'  => $parameters['auth']['client_secret'],
            'redirectUri'   => "http://".$_SERVER['HTTP_HOST']."/Authenticators/".$this->dispatcher->getControllerName(),
            'scopes'        => $parameters['auth']['scope'],
            'approval_prompt'=>'force',
            'access_type'=>'offline'
            ]);

            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code'] 
            ]);

            
            if($this->authorizationHeader==null)
            {
                $this->authorizationHeader= $provider->authorizationHeader;
            }
            $storage_data['Authorization'] = $this->authorizationHeader." ".$token->accessToken;
            $storage_data['refresh_token'] = $token->refreshToken;
            $storage_data['token_expiry'] = $token->expires;
            $data_connector->storage = json_encode($storage_data);
            $data_connector->save();
        }

        echo '<h1>Token Was Obtained Successfully</h1>';
        
    }

    public function RefreshTokenAction($data_connector_id)
    {
        $data_connector = DataConnector::findFirstByid($data_connector_id);
        $parameters=(array)json_decode($data_connector->parameters,true);
        if(array_key_exists ( 'auth' , $parameters))
        {  
         $provider = new $this->provider_name([
        'clientId'      => $parameters['auth']['client_id'],
        'clientSecret'  => $parameters['auth']['client_secret'],
        'redirectUri'   => "http://".$_SERVER['HTTP_HOST']."/Authenticators/".$this->dispatcher->getControllerName(),
        ]);
        }

        $storage_data=(array)json_decode($data_connector->storage,true);

        $grant = new \League\OAuth2\Client\Grant\RefreshToken();
        $token = $provider->getAccessToken($grant, ['refresh_token' => $storage_data['refresh_token']]);


        if($this->authorizationHeader==null)
        {
            $this->authorizationHeader= $provider->authorizationHeader;
        }

        $storage_data['Authorization'] = $this->authorizationHeader." ".$token->accessToken;

        $data_connector->storage = json_encode($storage_data);

        $data_connector->save();
        
        return '<h1>Refreshing Token Was Successful</h1>';

    }

}
