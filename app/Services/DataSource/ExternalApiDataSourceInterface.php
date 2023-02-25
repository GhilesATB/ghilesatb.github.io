<?php

namespace App\Services\DataSource;

/*
 * Data fetching interface for External API data source
 */
interface ExternalApiDataSourceInterface
{
    public function RequestData(string $uri, array $params): Object;
}
