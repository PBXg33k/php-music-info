<?php
namespace Pbxg33k\MusicInfo\Model;


interface IMusicServiceEndpoint
{
    /**
     * @param $apiService
     *
     * @return mixed
     */
    public function setParent($apiService);

    public function transformSingle($raw);

    public function transformCollection($raw);

    public function transform($raw);

    /**
     * @return mixed
     */
    public function getParent();

    /**
     * @param $arguments
     * @return mixed
     */
    public function get($arguments);

    /**
     * @param $arguments
     * @return mixed
     */
    public function getComplete($arguments);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $name
     * @return mixed
     */
    public function getByName($name);

    /**
     * @param $guid
     * @return mixed
     */
    public function getByGuid($guid);
}