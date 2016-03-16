<?php

namespace Craft;

class SitemapController extends BaseController
{
    public function actionSaveSections($ping = false)
    {
        $no_err = true;
        $this->requirePostRequest();


        $sections = craft()->request->getPost('sections');

        $models = SitemapModel::populateModels($sections);

        foreach( $models as $mod) {
            $mod->included = !empty($mod->included) ? 1 : 0;
            if($ping && $mod->included > 0) {
                $mod->ping_date = date("Y-m-d H:i:s");
            }
            $no_err = craft()->sitemap->saveSections($mod);
        }
        if($no_err) {
            craft()->userSession->setNotice(Craft::t('Sitemap Settings Saved'));
        } else {
            craft()->userSession->setNotice(Craft::t('Error'));
        }

        // Not generating static file due to Route automatically generating sitemap.xml
        // craft()->sitemap->generateSitemap();

    }

    public function actionPingSections()
    {
        $this->actionSaveSections(true);
        craft()->sitemap->pingSearchEngines();
        craft()->userSession->setNotice(Craft::t('Search Engines have been pinged'));
    }

    public function actionIndex()
  	{
      $entRec = EntryRecord::model();
      $base_url = UrlHelper::getSiteUrl();
  		$xml = new \SimpleXMLElement(
  			'<?xml version="1.0" encoding="UTF-8"?>' .
  			'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>'
  		);
      $sections = craft()->sitemap->getAllIncludedSections();
      foreach($sections as $section) {
          $entries = $entRec->findAll('sectionId=:id', array('id' => $section->sectionId));
          $models = EntryModel::populateModels($entries);
          foreach($models as $entry) {
              $element = ElementRecord::model()->find('id=:id', array('id' => $entry->id));
              if($element->enabled == 1) {
                  $elementLoc = ElementLocaleRecord::model()->find('elementId=:id', array('id' => $entry->id));
                  $url = $xml->addChild('url');
                  $url->addChild('loc', $base_url . ($elementLoc->uri == '__home__' ? '' : $elementLoc->uri));
          				$url->addChild('lastmod', $entry->dateUpdated->format(\DateTime::W3C));
                  $url->addChild('changefreq', $section->frequency);
          				$url->addChild('priority', $section->priority);
              }
          }
      }
  		HeaderHelper::setContentTypeByExtension('xml');
  		ob_start();
  		echo $xml->asXML();
  		craft()->end();
  	}
}
