<?php

/**
 * File containing the LocationPurger class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\MVC\Symfony\Cache\Http;

/**
 * Interface allowing for HttpCache stores to purge specific content.
 * When purging content by tags, purgeByRequest() would receive a Request object with X-Location-Id headers
 * indicating which objects to purge.
 */
interface ContentPurger extends RequestAwarePurger
{
    /**
     * Purges all cached content.
     *
     * @return bool
     */
    public function purgeAllContent();
}
