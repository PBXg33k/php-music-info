<?php
/*******************************************************************************
 * This file is part of the Pbxg33k\MusicInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * (c) 2017 Oguzhan uysal. All rights reserved
 ******************************************************************************/

namespace Pbxg33k\MusicInfo;

use Pbxg33k\MusicInfo\DependencyInjection\MusicInfoExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class Pbxg33kMusicInfoBundle
 *
 * @package Pbxg33k\MusicInfo
 */
class Pbxg33kMusicInfoBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new MusicInfoExtension();
        }

        return $this->extension;
    }
}