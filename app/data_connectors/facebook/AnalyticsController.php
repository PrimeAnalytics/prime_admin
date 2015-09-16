<?php
namespace PRIME\DataConnectors\Google\Youtube;
use PRIME\DataConnectors\DataConnectorBase as ConnectorBase;

class YoutubeController extends ConnectorBase
{
    
    public function initialize()
    {
        $this->icon ="fa-google";
        $this->form_struct ='{"parm":
        [
        {"name":"client_id","label":"Client ID","type":"input" },
        {"name":"client_secret","label":"Client Secret","type":"input" },
        {"name":"ids","label":"IDs","type":"input" },
        {"name":"start_date","label":"Start Date","type":"input" },
        {"name":"end_date","label":"End Date","type":"input" },
        {"name":"metrics","label":"Metrics","type":"input" }
        ]
        }';
     }

    public function loginAction()
    {
        $data=(array)json_decode($widget->parameters,true);

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("https://www.googleapis.com/auth/youtube");

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        } else {
            $authUrl = $client->createAuthUrl();
        }

        if ($client->getAccessToken()) {
            $_SESSION['access_token'] = $client->getAccessToken();
            $dr_results = $dr_service->files->listFiles(array('maxResults' => 10));
            $yt_channels = $yt_service->channels->listChannels('contentDetails', array("mine" => true));
            $likePlaylist = $yt_channels[0]->contentDetails->relatedPlaylists->likes;
            $yt_results = $yt_service->playlistItems->listPlaylistItems(
                "snippet",
                array("playlistId" => $likePlaylist)
            );
        }
    }

    public function reportAction()
    {

        if (isset($authUrl)) {
          echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
        } else {
          echo "<h3>Results Of Drive List:</h3>";
          foreach ($dr_results as $item) {
            echo $item->title, "<br /> \n";
          }
          echo "<h3>Results Of YouTube Likes:</h3>";
          foreach ($yt_results as $item) {
            echo $item['snippet']['title'], "<br /> \n";
          }
        }
    
    }
}
