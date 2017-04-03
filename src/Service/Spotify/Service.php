<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Service\Spotify;

use Pbxg33k\MusicInfo\Service\BaseService;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Album;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Artist;
use Pbxg33k\MusicInfo\Service\Spotify\Endpoint\Track;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Service
 *
 * @package Pbxg33k\MusicInfo\Service\Spotify
 */
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
     * @var Artist
     */
    protected $artist;

    /**
     * @var Track
     */
    protected $track;

    /**
     * @var Album
     */
    protected $album;

    /**
     * {@inheritdoc}
     */
    public function init($config = [])
    {
        if (empty($config)) {
            $config = $this->getConfig();
        }

        $this->spotifySession = new Session($config['client_id'], $config['client_secret'], $config['redirect_uri']);
        $this->setApiClient(new SpotifyWebAPI());

        $this->requestCredentialsToken($config['scopes']);
        $this->setInitialized(true);

        $this->artist = new Artist($this, $this->getCache());
        $this->track  = new Track($this, $this->getCache());
        $this->album  = new Album($this, $this->getCache());

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
     * @return Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return Track
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @return Album
     */
    public function getAlbum()
    {
        return $this->album;
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

    /**
     * @return Artist
     */
    public function artist()
    {
        return $this->artist;
    }

    /**
     * @return Track
     */
    public function track()
    {
        return $this->track;
    }

    /**
     * @return Album
     */
    public function album()
    {
        return $this->album;
    }

}
