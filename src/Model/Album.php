<?php
namespace Pbxg33k\MusicInfo\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Album
 * @package Model
 */
class Album extends BaseModel
{
    const TYPE_ALBUM        = 'album';
    const TYPE_SINGLE       = 'single';
    const TYPE_COMPILATION  = 'compilation';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var ArrayCollection
     */
    protected $artists;

    /**
     * @var ArrayCollection
     */
    protected $tracks;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var ArrayCollection
     */
    protected $genres;

    /**
     * @var \DateTimeInterface
     */
    protected $release_date;

    /**
     * @var string
     */
    protected $label;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Album
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Album
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * @param ArrayCollection $artists
     *
     * @return Album
     */
    public function setArtists($artists)
    {
        $this->artists = $artists;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * @param ArrayCollection $tracks
     *
     * @return Album
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return Album
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     *
     * @return Album
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param ArrayCollection $genres
     *
     * @return Album
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @param \DateTimeInterface $release_date
     *
     * @return Album
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return Album
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
}