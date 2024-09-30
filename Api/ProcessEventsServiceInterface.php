<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Api;

use Klevu\AnalyticsApi\Api\Data\ProcessEventsResultInterface;
use Klevu\Pipelines\Exception\ExtractionExceptionInterface;
use Klevu\Pipelines\Exception\Pipeline\InvalidPipelineConfigurationException;
use Klevu\Pipelines\Exception\TransformationExceptionInterface;
use Klevu\Pipelines\Exception\ValidationExceptionInterface;
use Klevu\PlatformPipelines\Exception\CouldNotGenerateConfigurationOverridesException;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ProcessEventsServiceInterface
{
    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @param string $via
     *
     * @return ProcessEventsResultInterface
     * @throws CouldNotGenerateConfigurationOverridesException
     * @throws ExtractionExceptionInterface
     * @throws InvalidPipelineConfigurationException
     * @throws TransformationExceptionInterface
     * @throws ValidationExceptionInterface
     */
    public function execute(
        ?SearchCriteriaInterface $searchCriteria = null,
        string $via = '',
    ): ProcessEventsResultInterface;
}
