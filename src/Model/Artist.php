<?php
namespace Pbxg33k\MusicInfo\Model;


class Artist extends BaseModel
{
    /**
     * Identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Artist Name
     *
     * @var string
     */
    protected $name;

    /**
     * Image URL
     *
     * @var string
     */
    protected $image;

    /**
     * Artist Type
     *
     * @var string
     */
    protected $type;

    /**
     * URI to data source
     *
     * @var string
     */
    protected $uri;

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
     * @return Artist
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
     * @return Artist
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @return Artist
     */
    public function setImage($image)
    {
        $this->image = $image;

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
     * @return Artist
     */
    public function setType($type)
    {
        $this->type = $type;

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
     * @return Artist
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }
}