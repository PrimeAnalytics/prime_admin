<?php

namespace Grumpydictator\NestOauth2Provider\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;


/**
 * Class Nest
 *
 * @package Grumpydictator\NestOauth2Provider\Provider
 */
class NestProvider extends AbstractProvider
{

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {

        parent::__construct($options);
    }

    /**
     * Get the URL that this provider uses to begin authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return 'https://home.nest.com/login/oauth2';
    }

    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return 'https://api.home.nest.com/oauth2/access_token';
    }

    /**
     * Get the URL that this provider uses to request user details.
     *
     * Since this URL is typically an authorized route, most providers will require you to pass the access_token as
     * a parameter to the request. For example, the google url is:
     *
     * 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='.$token
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function urlUserDetails(AccessToken $token)
    {
        return 'https://developer-api.nest.com/?auth=' . $token->accessToken;
    }

    /**
     * Given an object response from the server, process the user details into a format expected by the user
     * of the client.
     *
     * @param object      $response
     * @param AccessToken $token
     *
     * @return Nest
     */
    public function userDetails($response, AccessToken $token)
    {

        return new Nest($response);
    }
}