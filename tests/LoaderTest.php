<?php

declare(strict_types=1);

namespace SH\GutenbergBlocks\Tests;

use SH\GutenbergBlocks\Loader;
use ReflectionClass;

use function Brain\Monkey\Functions\when;

class LoaderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        when('plugin_dir_path')->returnArg();
        when('plugin_dir_url')->returnArg();
    }

    public function testpluginConfigHasAttributes()
    {
        $frameworkLoader = new Loader(__FILE__);
        $loaderClassReflection = new ReflectionClass($frameworkLoader);
        $loaderClassPluginConfig = $loaderClassReflection->getProperty('pluginConfig');
        $loaderClassPluginConfig->setAccessible(true);

        $pluginCongfig = $loaderClassPluginConfig->getValue($frameworkLoader);

        $this->assertObjectHasAttribute('blockWhitelist', $pluginCongfig);
        $this->assertObjectHasAttribute('dirPath', $pluginCongfig);
        $this->assertObjectHasAttribute('dirUrl', $pluginCongfig);
        $this->assertObjectHasAttribute('distDir', $pluginCongfig);
        $this->assertObjectHasAttribute('prefix', $pluginCongfig);
        $this->assertObjectHasAttribute('viewClass', $pluginCongfig);
    }

    /**
     * @dataProvider dataProviderForTestValidPrefix
     */
    public function testValidPrefix(string $file, string $prefix)
    {
        $frameworkLoader = new Loader($file);
        $loaderClassReflection = new ReflectionClass($frameworkLoader);
        $loaderClassPluginConfig = $loaderClassReflection->getProperty('pluginConfig');
        $loaderClassPluginConfig->setAccessible(true);

        $pluginCongfig = $loaderClassPluginConfig->getValue($frameworkLoader);

        $this->assertEquals($prefix, $pluginCongfig->prefix);
    }

    public function testInitHasHooks()
    {
        $frameworkLoader = new Loader(__FILE__);
        $frameworkLoader
            ->loadBlocks('src/', __NAMESPACE__)
            ->init();

        $this->assertNotFalse(has_action('load-post-new.php', '\SH\GutenbergBlocks\TemplateCollector->registerTemplates()'));
        $this->assertNotFalse(has_action('enqueue_block_assets', '\SH\GutenbergBlocks\AssetCollector->enqueueAssets()'));
        $this->assertNotFalse(has_action('enqueue_block_editor_assets', '\SH\GutenbergBlocks\AssetCollector->enqueueEditorAssets()'));
        $this->assertNotFalse(has_action('init', '\SH\GutenbergBlocks\BlockCollector->registerBlocks()'));
        $this->assertNotFalse(has_action('wp_enqueue_scripts', '\SH\GutenbergBlocks\AssetCollector->enqueueScripts()'));
        $this->assertNotFalse(has_filter('allowed_block_types_all', '\SH\GutenbergBlocks\BlockCollector->filterBlocks()'));
        $this->assertNotFalse(has_filter('block_categories_all'));
    }

    public function dataProviderForTestValidPrefix()
    {
        return [
            ['SH-gutenberg-blocks/bootstrap.php', 'SH'],
            ['my-long-prefix-gutenberg-blocks/bootstrap.php', 'my-long-prefix'],
            ['prefix-with-gutenberg-gutenberg-blocks/bootstrap.php', 'prefix-with-gutenberg'],
            ['prefix-with-gutenberg-blocks-gutenberg-blocks/bootstrap.php', 'prefix-with-gutenberg-blocks'],
        ];
    }
}