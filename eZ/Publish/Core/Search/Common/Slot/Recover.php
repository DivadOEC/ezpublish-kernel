<?php

/**
 * This file is part of the eZ Publish Kernel package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace eZ\Publish\Core\Search\Common\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use eZ\Publish\Core\Search\Common\Slot;

/**
 * A Search Engine slot handling RecoverSignal.
 */
class Recover extends Slot
{
    /**
     * Receive the given $signal and react on it.
     *
     * @param \eZ\Publish\Core\SignalSlot\Signal $signal
     */
    public function receive(Signal $signal)
    {
        if (!$signal instanceof Signal\TrashService\RecoverSignal) {
            return;
        }

        $contentHandler = $this->persistenceHandler->contentHandler();

        foreach ($this->persistenceHandler->locationHandler()->loadSubtreeIds($signal->newLocationId) as $contentId) {
            $contentInfo = $contentHandler->loadContentInfo($contentId);
            $this->searchHandler->indexContent(
                $contentHandler->load($contentInfo->id, $contentInfo->currentVersionNo)
            );

            $this->searchHandler->indexLocation(
                $this->persistenceHandler->locationHandler()->load($signal->newLocationId)
            );
        }
    }
}
