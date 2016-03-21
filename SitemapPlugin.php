<?php
namespace Craft;

class SitemapPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Sitemap');
    }

    function getVersion()
    {
        return '1.1.1';
    }

    function getDeveloper()
    {
        return 'Taylor Ryan (modified from nxnw/craft-sitemap)';
    }

    function getDeveloperUrl()
    {
        return 'https://github.com/yatryan/craft-sitemap';
    }

    public function hasCpSection()
    {
        return true;
    }

    public function registerSiteRoutes()
  	{
  		return array(
  			'sitemap.xml' => array('action' => 'sitemap/index'),
  		);
  	}

    public function onBeforeUninstall()
    {
      $sitemapPath = $_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml';
      if (file_exists($sitemapPath)) {
        unlink($sitemapPath);
      }
    }
}
