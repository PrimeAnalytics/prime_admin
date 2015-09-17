# Nest provider for league/oauth2-client

This is a package to integrate Google Nest authentication with the OAuth2 client library by
[The League of Extraordinary Packages](https://github.com/thephpleague/oauth2-client).

To install, use composer:

```bash
composer require grumpydictator/nest-oauth2-provider
```

## Usage

Usage is the same as the league's OAuth client, using `\Grumpydictator\NestOauth2Provider\Provider\NestProvider` as the provider.

### Authorization Code Flow


Example:

```php
$provider = new \Grumpydictator\NestOauth2Provider\Provider\NestProvider([
    'clientId'  =>  'XXXXXXXX',
    'clientSecret'  =>  'XXXXXXXX',
));

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->state;
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    $token = $provider->getAccessToken('authorization_code', [
    	'code' => $_GET['code'],
    	'grant_type' => 'authorization_code'
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the Nest details
        $nest = $provider->getUserDetails($token);

        // show all structures and thermostats:
        /** @var \Grumpydictator\NestOauth2Provider\Provider\Structure $structure */
        foreach($nest->getStructures() as $structure) {
            echo $structure->name."\n"; 
            /** @var \Grumpydictator\NestOauth2Provider\Provider\Thermostat $thermostat */
            foreach($structure->getThermostats() as $thermostat) {
                echo $thermostat->name_long.': ' . $thermostat->ambient_temperature_c.'C'."\n";
            }
            /** @var \Grumpydictator\NestOauth2Provider\Provider\SmokeCoAlarm $alarm */
            foreach($structure->getSmokeCoAlarms() as $alarm) {
                echo $alarm->name_long.': ' . $alarm->co_alarm_state.'/' . $alarm->smoke_alarm_state ."\n";
            }

        }

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->accessToken;

    // Unix timestamp of when the access token will expire, and need refreshing
    echo $token->expires;
}
```

### Refreshing a Token

The Google Nest API's access token is valid for ~10 years, and should not need refreshing.