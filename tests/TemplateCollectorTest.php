<?php

declare(strict_types=1);

namespace SH\GutenbergBlocks\Tests;

use SH\GutenbergBlocks\PluginConfigDTO;
use ReflectionClass;
use SH\GutenbergBlocks\TemplateCollector;

class TemplateCollectorTest extends TestCase
{
    public function testAddNamespaceToBlockName()
    {
        $this->pluginConfig = new PluginConfigDTO();
        $this->pluginConfig->prefix = 'prefix';

        $templateCollector = new TemplateCollector($this->pluginConfig);
        $templateCollectorReflection = new ReflectionClass($templateCollector);

        $templateCollectorAddNamespace = $templateCollectorReflection->getMethod('addNamespaceToBlockName');
        $templateCollectorAddNamespace->setAccessible(true);
        $result = $templateCollectorAddNamespace->invokeArgs($templateCollector, [[
            ['core/image'],
            ['example-block'],
        ]]);

        $this->assertEquals([
            ['core/image'],
            ['prefix/example-block'],
        ], $result);
    }
}