<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Api;

use Klevu\AnalyticsApi\Api\Data\ProcessEventsResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ProcessEventsServiceInterface
{
    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @param string $via
     * @return ProcessEventsResultInterface
     */
    public function execute(
        ?SearchCriteriaInterface $searchCriteria = null,
        string $via = '',
    ): ProcessEventsResultInterface;
}
