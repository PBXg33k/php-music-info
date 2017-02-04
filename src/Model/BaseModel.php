<?php
namespace Pbxg33k\MusicInfo\Model;


class BaseModel
{
    /**
     * Data source identifier
     *
     * @var string
     */
    protected $dataSource;

    /**
     * Raw data as array representation
     *
     * @var array
     */
    protected $rawData;

    /**
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @param string $dataSource
     *
     * @return BaseModel
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * @return array
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @param array $rawData
     *
     * @return BaseModel
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;

        return $this;
    }
}