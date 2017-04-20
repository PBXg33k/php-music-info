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


use Pbxg33k\Traits\PropertyTrait;

abstract class BaseModel
{
    use PropertyTrait;

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
     * @param mixed $rawData
     *
     * @return BaseModel
     */
    public function setRawData($rawData)
    {
        $this->rawData = $rawData;

        return $this;
    }
}
