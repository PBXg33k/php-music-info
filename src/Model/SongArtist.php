<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 10/21/2016
 * Time: 6:39 PM
 */

namespace Pbxg33k\MusicInfo\Model;


/**
 * Class SongArtist
 * @package Pbxg33k\MusicInfo\Model
 */
class SongArtist extends BaseModel
{
    /**
     * @var Song
     */
    protected $song;

    /**
     * @var Artist
     */
    protected $artist;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var string
     */
    protected $joinphrase;

    /**
     * @var integer
     */
    protected $order;

    /**
     * @return Song
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * @param Song $song
     * @return SongArtist
     */
    public function setSong($song)
    {
        $this->song = $song;
        return $this;
    }

    /**
     * @return Artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param Artist $artist
     * @return SongArtist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return SongArtist
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getJoinphrase()
    {
        return $this->joinphrase;
    }

    /**
     * @param string $joinphrase
     * @return SongArtist
     */
    public function setJoinphrase($joinphrase)
    {
        $this->joinphrase = $joinphrase;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return SongArtist
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }


}