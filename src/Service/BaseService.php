<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo\Service;

use Pbxg33k\InfoBase\Exception\ServiceConfigurationException;
use Pbxg33k\InfoBase\Model\IService;
use Pbxg33k\InfoBase\Service\BaseService as InfoBase;

class BaseService extends InfoBase implements IService
{
    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function artist()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function album()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function song()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }

    /**
     *
     * @throws ServiceConfigurationException
     * @return IMusicServiceEndpoint
     */
    public function track()
    {
        throw new ServiceConfigurationException(self::ERR_METHOD_NOT_IMPLEMENTED);
    }
}
