<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Api\Data;

use Klevu\AnalyticsApi\Model\Source\ProcessEventsResultStatuses;

interface ProcessEventsResultInterface
{
    /**
     * @return ProcessEventsResultStatuses|null
     */
    public function getStatus(): ?ProcessEventsResultStatuses;

    /**
     * @param ProcessEventsResultStatuses $status
     * @return void
     */
    public function setStatus(ProcessEventsResultStatuses $status): void;

    /**
     * @return string[]
     */
    public function getMessages(): array;

    /**
     * @param string[] $messages
     * @return void
     */
    public function setMessages(array $messages): void;

    /**
     * @return mixed
     */
    public function getPipelineResult(): mixed;

    /**
     * @param mixed $pipelineResult
     * @return void
     */
    public function setPipelineResult(mixed $pipelineResult): void;
}
