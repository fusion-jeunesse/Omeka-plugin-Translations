<?php
/**
 * Translations
 *
 * Allows to add specific translations of strings, in particular the hard-coded
 * texts in the theme.
 *
 * @copyright Daniel Berthereau, 2018
 * @license https://www.cecill.info/licences/Licence_CeCILL_V2.1-en.html
 */

class TranslationsPlugin extends Omeka_Plugin_AbstractPlugin
{
    /**
     * @var array Hooks for the plugin.
     */
    protected $_hooks = array(
        'config',
        'config_form',
        'initialize',
    );

    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        add_translation_source(dirname(__FILE__) . '/languages');
    }

    public function hookConfigForm()
    {
        $cache_dir = null;
        if( $cache = $this->_getLocaleCache() and $backend = $cache->getBackend() )
            $cache_dir = $backend->getOption('cache_dir');
        $view = get_view();
        include 'config_form.php';
    }

    public function hookConfig($args)
    {
        if (isset($args['post']['clear_cache']))
        if (0 !== (int) $args['post']['clear_cache'] ) {
            if( $cache = $this->_getLocaleCache() and $backend = $cache->getBackend() )
                if ($backend->clean())
                    throw new Omeka_Validate_Exception(__('Translation cache successfully cleared'));
                else
                    throw new Omeka_Validate_Exception(__('Translation cache could not be cleared'));

        }
    }

    protected function _getLocaleCache() {
        $cache = null;
        $bootstrap = Zend_Registry::get('bootstrap');
        if ($bootstrap instanceof Zend_Application_Bootstrap_ResourceBootstrapper &&
            $bootstrap->hasPluginResource('CacheManager')
        ) {
            $cacheManager = $bootstrap->bootstrap('CacheManager')
              ->getResource('CacheManager');
            if (null !== $cacheManager &&
                $cacheManager->hasCache('locale')
            ) {
                $cache = $cacheManager->getCache('locale');
            }
        }
        return $cache;
    }

}
