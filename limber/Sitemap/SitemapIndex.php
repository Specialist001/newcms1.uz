<?php
namespace Limber\Sitemap;

class SitemapIndex extends AbstractSitemap
{
    protected $root = 'sitemapindex';

    public function addItem($loc, $lastmod = null)
    {
        if ($this->autoEscape) {
            $loc = htmlspecialchars($loc);
        }

        $sitemap = $this->xml->addChild('sitemap');

        $sitemap->addChild('loc', $loc);

        if ($lastmod) {
            if (!($lastmod instanceof \DateTime)) {
                $lastmod = new \DateTime($lastmod);
            }

            $sitemap->addChild('lastmod', $lastmod->format($this->dateFormat));
        }

        return $this;
    }
}