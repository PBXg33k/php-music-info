<?php
namespace Pbxg33k\MusicInfo\Model;


use Doctrine\Common\Collections\ArrayCollection;

interface IMusicServiceEndpoint
{
    /**
     * @param $apiService
     *
     * @return mixed
     */
    public function setParent($apiService);

    /**
     * Transform single item to model
     *
     * @param $raw
     *
     * @return BaseModel
     */
    public function transformSingle($raw);

    /**
     * Transform collection to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transformCollection($raw);

    /**
     * Transform to models
     *
     * @param $raw
     *
     * @return ArrayCollection
     */
    public function transform($raw);

    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function get($arguments);

    /**
     * @param $arguments
     *
     * @return mixed
     */
    public function getComplete($arguments);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getByName($name);

    /**
     * @param $guid
     *
     * @return mixed
     */
    public function getByGuid($guid);
}