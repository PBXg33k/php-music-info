<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 30-May-16
 * Time: 13:01
 */

namespace Pbxg33k\MusicInfo\Service\Spotify;

use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use Symfony\Component\HttpFoundation\Request;

class Service extends BaseService
{
    /**
     * Is the client authorized via OAuth2.0
     *
     * @var bool
     */
    protected $authorized = false;

    /**
     * @var Session
     */
    protected $spotifySession;

    /**
     * Endpoints
     */
    protected $artist;

    /**
     * {@inheritdoc}
     */
    public function init($config = [])
    {
        if(!$config) {
            $config = $this->getConfig();
        }

        $this->spotifySession = new Session($config['client_id'], $config['client_secret'], $config['redirect_uri']);
        $this->setApiClient(new SpotifyWebAPI());

        $this->requestCredentialsToken($config['scopes']);
        
        $this->artist = new Artist($this);

        return $this;
    }

    /**
     * @param $scopes
     *
     * @return mixed
     */
    public function requestCredentialsToken($scopes)
    {
        $this->spotifySession->requestCredentialsToken($scopes);
        return $this->setAccessTokenFromSession();
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function requestAccessToken(Request $request)
    {
        $this->spotifySession->requestAccessToken($request->query->get('code'));
        $this->setAccessTokenFromSession();
        return $this->getApiClient()->getAccessToken();
    }

    /**
     * @return bool
     */
    public function refreshTokens()
    {
        return $this->spotifySession->refreshAccessToken($this->spotifySession->getRefreshToken());
    }

    /**
     * @return mixed
     */
    protected function setAccessTokenFromSession()
    {
        return $this->getApiClient()->setAccessToken($this->spotifySession->getAccessToken());
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return Session
     */
    public function getSpotifySession()
    {
        return $this->spotifySession;
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return $this->authorized;
    }
    
    
}