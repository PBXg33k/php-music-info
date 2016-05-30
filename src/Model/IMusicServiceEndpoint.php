<?php
namespace Pbxg33k\MusicInfo\Model;


interface IMusicServiceEndpoint
{
    /**
     * @return mixed
     */
    function setParent($apiService);

    /**
     * @return mixed
     */
    function getParent();

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