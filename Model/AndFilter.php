<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Model;

use Magento\Framework\Api\Filter;

class AndFilter extends Filter
{
    public const FILTERS = 'filters';

    /**
     * Returns a list of filters in this group
     *
     * @return Filter[]
     */
    public function getFilters(): array
    {
        $filters = $this->_get(static::FILTERS);

        return $filters ?? [];
    }

    /**
     * Set filters
     *
     * @param Filter[] $filters
     * @return $this
     * @codeCoverageIgnore
     */
    public function setFilters(array $filters): self
    {
        return $this->setData(static::FILTERS, $filters);
    }
}
