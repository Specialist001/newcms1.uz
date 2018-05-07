<?php
namespace Limber\Sitemap;


class Sitemap extends AbstractSitemap
{
    protected $root = 'urlset';

    public function addItem($loc, $priority = null, $changefreq = null, $lastmod = null)
    {
        if ($this->autoEscape) {
            $loc = htmlspecialchars($loc);
        }

        $url = $this->xml->addChild('url');

        $url->addChild('loc', $loc);

        $changefreq ? $url->addChild('changefreq', $changefreq) : null;
        $priority   ? $url->addChild('priority', $priority)     : null;

        if ($lastmod) {
            if (!($lastmod instanceof \DateTime)) {
                $lastmod = new \DateTime($lastmod);
            }

            $url->addChild('lastmod', $lastmod->format($this->dateFormat));
        }

        return $this;
    }
}