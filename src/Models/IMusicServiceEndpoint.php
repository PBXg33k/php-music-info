<?php
namespace Pbxg33k\MusicInfo\Models;


interface IMusicServiceEndpoint
{
    public function __construct($apiClient);

    function getApiService();

    public function get($arguments);

    public function getComplete($arguments);

    public function getById($id);

    public function getByName($name);

    public function getByGuid($guid);
}