<?php

/**
 * Copyright © Klevu Oy. All rights reserved. See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Klevu\AnalyticsApi\Model\Source;

enum ProcessEventsResultStatuses: string
{
    case SUCCESS = 'success';
    case PARTIAL = 'partial';
    case ERROR = 'error';
    case NOOP = 'noop';
}
