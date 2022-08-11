<?php
/**
 * Plugin Name:     Example Plugin
 * Plugin URI:      https://www.veronalabs.com
 * Plugin Prefix:   EXAMPLE_PLUGIN
 * Description:     Example WordPress Plugin Based on Rabbit Framework!
 * Author:          VeronaLabs
 * Author URI:      https://veronalabs.com
 * Text Domain:     example-plugin
 * Domain Path:     /languages
 * Version:         1.0
 */

use Rabbit\Application;
use Rabbit\Database\DatabaseServiceProvider;
use Rabbit\Logger\LoggerServiceProvider;
use Rabbit\Plugin;
use Rabbit\Redirects\AdminNotice;
use Rabbit\Templates\TemplatesServiceProvider;
use Rabbit\Utils\Singleton;
use League\Container\Container;

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Class ExamplePluginInit
 * @package ExamplePluginInit
 */
class ExamplePluginInit extends Singleton
{
    /**
     * @var Container
     */
    private $application;

    /**
     * ExamplePluginInit constructor.
     */
    public function __construct()
    {
        $this->application = Application::get()->loadPlugin(__DIR__, __FILE__, 'config');
        $this->init();
    }

    public function init()
    {
        try {

            /**
             * Load service providers
             */
            $this->application->addServiceProvider(RedirectServiceProvider::class);
            $this->application->addServiceProvider(DatabaseServiceProvider::class);
            $this->application->addServiceProvider(TemplatesServiceProvider::class);
            $this->application->addServiceProvider(LoggerServiceProvider::class);
            // Load your own service providers here...


            /**
             * Activation hooks
             */
            $this->application->onActivation(function () {
                // Create tables or something else
            });

            /**
             * Deactivation hooks
             */
            $this->application->onDeactivation(function () {
                // Clear events, cache or something else
            });

            $this->application->boot(function (Plugin $plugin) {
                $plugin->loadPluginTextDomain();

                // load template
                $this->application->view('plugin-template.php', ['foo' => 'bar']);
                ///...

            });

        } catch (Exception $e) {
            /**
             * Print the exception message to admin notice area
             */
            add_action('admin_notices', function () use ($e) {
                AdminNotice::permanent(['type' => 'error', 'message' => $e->getMessage()]);
            });

            /**
             * Log the exception to file
             */
            add_action('init', function () use ($e) {
                if ($this->application->has('logger')) {
                    $this->application->get('logger')->warning($e->getMessage());
                }
            });
        }
    }

    /**
     * @return Container
     */
    public function getApplication()
    {
        return $this->application;
    }
}

/**
 * Returns the main instance of ExamplePluginInit.
 *
 * @return ExamplePluginInit
 */
function examplePlugin()
{
    return ExamplePluginInit::get();
}

examplePlugin();