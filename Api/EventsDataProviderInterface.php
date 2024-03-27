<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface EventsDataProviderInterface
{
    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return iterable<mixed>|\Generator|null
     */
    public function get(
        ?SearchCriteriaInterface $searchCriteria = null,
    ): iterable|\Generator|null;
}
