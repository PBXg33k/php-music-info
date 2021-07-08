<?php
namespace Pbxg33k\MusicInfo\Model;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Song
 * @package Pbxg33k\MusicInfo\Model
 */
class Song extends BaseModel
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var SongArtist[]
     */
    protected $artist;

    /**
     * Duration in seconds
     *
     * @var integer
     */
    protected $duration;

    /**
     * International Standard Recording Code
     *
     * @var string
     */
    protected $isrc;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Song
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Song
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param ArrayCollection $artist
     * @return Song
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Song
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsrc()
    {
        return $this->isrc;
    }

    /**
     * @param string $isrc
     * @return Song
     */
    public function setIsrc($isrc)
    {
        $this->isrc = $isrc;
        return $this;
    }


}