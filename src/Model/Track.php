<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Model;

use GuzzleHttp\Psr7\Uri;

/**
 * Class Track
 *
 * @package Model
 */
class Track extends BaseModel
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $name;

    /**
     * @var
     */
    protected $image;

    /**
     * @var Uri
     */
    protected $uri;

    /**
     * @var
     */
    protected $explicit;

    /**
     * @var integer
     */
    protected $length;

    /**
     * @var Uri
     */
    protected $preview_uri;

    /**
     * @var
     */
    protected $albumTrack;

    /**
     * @var
     */
    protected $trackArtists;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Track
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return Track
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     *
     * @return Track
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     *
     * @return Track
     */
    public function setUri(Uri $uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlbumTrack()
    {
        return $this->albumTrack;
    }

    /**
     * @param mixed $albumTrack
     *
     * @return Track
     */
    public function setAlbumTrack($albumTrack)
    {
        $this->albumTrack = $albumTrack;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrackArtists()
    {
        return $this->trackArtists;
    }

    /**
     * @param mixed $trackArtists
     *
     * @return Track
     */
    public function setTrackArtists($trackArtists)
    {
        $this->trackArtists = $trackArtists;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExplicit()
    {
        return $this->explicit;
    }

    /**
     * @param mixed $explicit
     *
     * @return Track
     */
    public function setExplicit($explicit)
    {
        $this->explicit = $explicit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return Track
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return Uri
     */
    public function getPreviewUri()
    {
        return $this->preview_uri;
    }

    /**
     * @param Uri $preview_uri
     *
     * @return Track
     */
    public function setPreviewUri(Uri $preview_uri)
    {
        $this->preview_uri = $preview_uri;

        return $this;
    }

}
