<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Model;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SimpleBuilderInterface;

class AndFilterBuilder implements SimpleBuilderInterface
{
    /**
     * @var AndFilterFactory
     */
    private readonly AndFilterFactory $andFilterFactory;
    /**
     * @var mixed[]
     */
    private array $data = [];

    /**
     * @param AndFilterFactory $andFilterFactory
     */
    public function __construct(
        AndFilterFactory $andFilterFactory,
    ) {
        $this->andFilterFactory = $andFilterFactory;
    }

    /**
     * @return AndFilter
     */
    public function create(): AndFilter
    {
        $andFilter = $this->andFilterFactory->create([
            'data' => $this->getData(),
        ]);
        $this->data = [];

        return $andFilter;
    }

    /**
     * @return mixed[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function setField(string $field): self
    {
        $this->data[AndFilter::KEY_FIELD] = $field;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue(mixed $value): self
    {
        $this->data[AndFilter::KEY_VALUE] = $value;

        return $this;
    }

    /**
     * @param string $conditionType
     * @return $this
     */
    public function setConditionType(string $conditionType): self
    {
        $this->data[AndFilter::KEY_CONDITION_TYPE] = $conditionType;

        return $this;
    }

    /**
     * @param Filter $filter
     * @return $this
     */
    public function addFilter(Filter $filter): self
    {
        $this->data[AndFilter::FILTERS][] = $filter;

        return $this;
    }

    /**
     * @param Filter[] $filters
     * @return $this
     */
    public function setFilters(array $filters): self
    {
        $this->data[AndFilter::FILTERS] = [];
        array_walk($filters, [$this, 'addFilter']);

        return $this;
    }
}
