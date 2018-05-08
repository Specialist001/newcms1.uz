<?php
namespace Modules\Admin\Controller;

use Limber;
use Limber\Http\Input;
use Limber\Http\Uri;
use Modules\Admin\Model\Page as PageModel;
use Limber\Localization\I18n;
use Modules\Admin\Service\CustomField\CustomFieldService;
use \View;

class PageController extends AdminController
{
    public function listing()
    {
        I18n::instance()->load('pages/list');

        $pageModel = new PageModel();
        $pages     = $pageModel->getPages();

        return View::make('pages/list', [
           'pages' => $pages
        ]);
    }

    public function create()
    {
        I18n::instance()->load('pages/create');

        return View::make('pages/create');
    }

    public function edit($id)
    {
        I18n::instance()->load('pages/edit');

        $pageModel = new PageModel();
        $page      = $pageModel->getPage($id);

        $customFieldService = new CustomFieldService();

        $customFields = $customFieldService->getPageFields($page);

        return View::make('pages/edit', [
            'baseUrl' => Uri::base(),
            'page'    => $page,
            'pageTypes' => getTypes(),
            'layouts' => getLayouts(),
            'customFields' => $customFields
        ]);
    }

    public function add()
    {
        $params = Input::post();

        if (isset($params['title'])) {
            $page = new \Modules\Admin\Model\Page;
            $page->setAttribute('title', $params['title']);
            $page->setAttribute('content', $params['content']);
            $page->setAttribute('segment', \Limber\Helper\Text::transliteration($params['title']));
            $page->save();

            echo $page->getAttribute('id');
            exit;
        }
    }

    public function update()
    {
        $params = Input::post();

        $customFields = [];
        if (!empty($params['custom_fields'])) {
            parse_str($params['custom_fields'], $customFields);
        }

        if (isset($params['title'])) {
            $page = new \Modules\Admin\Model\Page;
            $page->setAttribute('id', $params['page_id']);
            $page->setAttribute('title', $params['title']);
            $page->setAttribute('content', $params['content']);
            $page->setAttribute('status', $params['status']);
            $page->setAttribute('layout', $params['layout']);
            $page->setAttribute('type', $params['type']);
            $page->save();

            if (isset($customFields['fields'])) {
                $customFieldValueModel = new Modules\Admin\Model\CustomFieldValue();
                foreach ($customFields['fields'] as $fieldId => $value) {
                    $customFieldValueModel->addUpdateFieldValue([
                        'field_id' => $fieldId,
                        'element_id' => $page->getAttribute('id'),
                        'value' => $value
                            ]);
                    }
            }

            echo $page->getAttribute('id');
            exit;
        }
    }
}