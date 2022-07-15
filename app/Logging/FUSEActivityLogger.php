<?php

namespace App\Logging;

use Monolog\Logger;

class FUSEActivityLogger
{
    /**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger("FUSEActivityLogHandler");
        return $logger->pushHandler(new FUSEActivityLogHandler());
    }
}
