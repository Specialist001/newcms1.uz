<?php
namespace Modules\SEOPack\Controller;

use Limber\Sitemap\Sitemap;
use Limber\Cms\Admin\Model\Page as PageModel;

class SitemapController extends \Controller
{
    public function show()
    {
        $pageModel = new PageModel();

        $pages = $pageModel->getPages();

        $sitemap = new Sitemap;
        $sitemap->addItem('https://matbaa.uz/');

        foreach ($pages as $page) {
            $sitemap->addItem('https://matbaa.uz/service/' . $page->getAttribute('segment'));
        }

        header('Content-Type: application/xml');

        echo $sitemap;

        exit;
    }
}