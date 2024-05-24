<?php

declare(strict_types=1);

namespace App;

use App\Configuration\Configuration;

class Action
{
    protected Configuration $configuration;

    /**
     *
     */
    public function __construct()
    {
        $this->configuration = new Configuration();
    }

    /**
     * @return void
     */
    public function run()
    {
        // $this->configuration->get('build.directory');
    }
}
