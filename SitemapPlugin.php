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
        return '1.0';
    }

    function getDeveloper()
    {
        return 'NXNW - Brandon Garcia-Acain';
    }

    function getDeveloperUrl()
    {
        return 'http://nxnw.net/';
    }

    public function hasCpSection()
    {
        return true;
    }

    protected function defineSettings()
    {
        return array(
            'siteRoute' => AttributeType::Bool,
            'multiLocale' => AttributeType::Bool
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('sitemap/_settings', array(
            'settings' => $this->getSettings()
        ));
    }
}