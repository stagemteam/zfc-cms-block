<?php

namespace Stagem\ZfcCmsBlock;

class ConfigProvider
{
    public function __invoke()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}