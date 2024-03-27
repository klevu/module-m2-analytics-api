<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

// phpcs:disable SlevomatCodingStandard.Classes.ClassStructure.IncorrectGroupOrder
// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Klevu\AnalyticsApi\Test\Integration\Model;

use Klevu\AnalyticsApi\Model\AndFilter;
use Klevu\AnalyticsApi\Model\AndFilterBuilder;
use Magento\Framework\Api\Filter;
use Magento\Framework\ObjectManagerInterface;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class AndFilterBuilderTest extends TestCase
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

    public function testCreate(): void
    {
        /** @var AndFilter $andFilter */
        $andFilter = $this->objectManager->create(AndFilter::class);
        /** @var Filter $coreFilter */
        $coreFilter = $this->objectManager->create(Filter::class);

        /** @var AndFilterBuilder $filterBuilder */
        $filterBuilder = $this->objectManager->get(AndFilterBuilder::class);

        $filterBuilder->setField('foo');
        $filterBuilder->setConditionType('neq');
        $filterBuilder->setValue('bar');
        $filterBuilder->setFilters([
            $andFilter,
            $coreFilter,
        ]);

        $expectedData = [
            Filter::KEY_FIELD => 'foo',
            Filter::KEY_CONDITION_TYPE => 'neq',
            Filter::KEY_VALUE => 'bar',
            AndFilter::FILTERS => [
                $andFilter,
                $coreFilter,
            ],
        ];
        $this->assertSame($expectedData, $filterBuilder->getData());

        $filter = $filterBuilder->create();
        $this->assertSame('foo', $filter->getField());
        $this->assertSame('neq', $filter->getConditionType());
        $this->assertSame('bar', $filter->getValue());
        $this->assertSame([$andFilter, $coreFilter], $filter->getFilters());
    }
}
