<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

// phpcs:disable SlevomatCodingStandard.Classes.ClassStructure.IncorrectGroupOrder
// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Klevu\AnalyticsApi\Test\Integration\Model;

use Klevu\AnalyticsApi\Model\AndFilter;
use Klevu\AnalyticsApi\Model\AndFilterFactory;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\ObjectManagerInterface;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class AndFilterTest extends TestCase
{
    /**
     * @var ObjectManagerInterface|null
     */
    private ?ObjectManagerInterface $objectManager = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->objectManager = ObjectManager::getInstance();
    }

    public function testInitFromFactory(): void
    {
        /** @var AndFilterFactory $filterFactory */
        $filterFactory = $this->objectManager->get(AndFilterFactory::class);
        $filter = $filterFactory->create([
            'data' => [
                'field' => 'foo',
                'condition_type' => 'neq',
                'value' => 'bar',
            ],
        ]);

        $this->assertSame('foo', $filter->getField());
        $this->assertSame('neq', $filter->getConditionType());
        $this->assertSame('bar', $filter->getValue());
        $this->assertSame([], $filter->getFilters());
    }

    public function testInitFromObjectManager(): void
    {
        /** @var AndFilterFactory $andFilterFactory */
        $andFilterFactory = $this->objectManager->get(AndFilterFactory::class);
        $andFilter = $andFilterFactory->create();

        /** @var FilterBuilder $filterBuilder */
        $filterBuilder = $this->objectManager->get(FilterBuilder::class);
        $coreFilter = $filterBuilder->create();

        /** @var AndFilter $filter */
        $filter = $this->objectManager->create(AndFilter::class, [
            'data' => [
                'filters' => [
                    $andFilter,
                    $coreFilter,
                ],
            ],
        ]);

        $this->assertNull($filter->getField());
        $this->assertSame('eq', $filter->getConditionType());
        $this->assertNull($filter->getValue());
        $this->assertSame([$andFilter, $coreFilter], $filter->getFilters());
    }

    public function testGetSetField(): void
    {
        /** @var AndFilter $filter */
        $filter = $this->objectManager->create(AndFilter::class);

        $this->assertNull($filter->getField());

        $filter->setField('foo');
        $this->assertSame('foo', $filter->getField());
    }

    public function testGetSetValue(): void
    {
        /** @var AndFilter $filter */
        $filter = $this->objectManager->create(AndFilter::class);

        $this->assertNull($filter->getValue());

        $filter->setValue('bar');
        $this->assertSame('bar', $filter->getValue());
    }

    public function testGetSetConditionType(): void
    {
        /** @var AndFilter $filter */
        $filter = $this->objectManager->create(AndFilter::class);

        $this->assertSame('eq', $filter->getConditionType());

        $filter->setConditionType('neq');
        $this->assertSame('neq', $filter->getConditionType());
    }

    public function testGetSetFilters(): void
    {
        /** @var AndFilter $andFilter */
        $andFilter = $this->objectManager->create(AndFilter::class);
        /** @var Filter $coreFilter */
        $coreFilter = $this->objectManager->create(Filter::class);

        /** @var AndFilter $filter */
        $filter = $this->objectManager->create(AndFilter::class);
        $filter->setFilters([
            $andFilter,
            $coreFilter,
        ]);

        $this->assertSame([$andFilter, $coreFilter], $filter->getFilters());
    }
}
