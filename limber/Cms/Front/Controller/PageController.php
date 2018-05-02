<?php
namespace Limber\Cms\Front\Controller;

use Limber\Template\View;
use Limber\Cms\Front\Model;

class PageController extends FrontController
{
    const DEFAULT_TEMPLATE = 'page';
    const MASK_TEMPLATE = 'page.%s';

    public function __construct()
    {
        parent::__construct();
    }

    public function show($segment)
    {
        class_alias('\\Limber\\Cms\\Fron\\Classes\\Page', 'Page');

        $pageModel = new Model\Page();
        $page = $pageModel->getPageBySegment($segment);

        $this->setLayout($page->getAttribute('layout'));
        \Page::setPage($page);

        return View::make($this->pageTemplate($page->getAttribute('type')), [
            'page' => $page
        ]);
    }

    private function pageTemplate(string $type)
    {
        $template = self::DEFAULT_TEMPLATE;
        if ($type !== self::DEFAULT_TEMPLATE) {
            $template = sprintf(self::MASK_TEMPLATE, $type);
        }
        return $template;
    }
}