<?php
namespace Modules\SEOPack\Controller;

use Limber\Config\Config;
use Limber\Sitemap\Sitemap;
use Modules\Backend\Model\Page as PageModel;

class SitemapController extends \Controller
{
    public function show()
    {
        $pageModel = new PageModel();

        $pages = $pageModel->getPages();

        $sitemap = new Sitemap;
        $sitemap->addItem(Config::item('baseUrl'));

        foreach ($pages as $page) {
            $sitemap->addItem(Config::item('baseUrl') . '/page/' . $page->getAttribute('segment'));
        }

        header('Content-Type: application/xml');

        echo $sitemap;

        exit;
    }
}