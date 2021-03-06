<?php
namespace Modules\Backend\Controller;

use Limber;
use View;
use Modules;
use Modules\Backend\Model;

class CategoryController extends BackendController
{
    protected $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new Model\Category();
    }

    /**
     * @param int $resourceTypeId
     * @return Limber\Template\View
     */
    public function create(int $resourceTypeId)
    {
        I18n::instance()->load('categories/create');

        $languageModel = new Model\Language();

        $this->setData('resourceTypeId', $resourceTypeId);
        $this->setData('languages', $languageModel->getLanguages());
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru'));
        return View::make('categories/create', $this->data);
    }

    public function edit(int $resourceTypeId, int $categoryId)
    {
        $languageModel = new Model\Language();
        $this->setData('languages', $languageModel->getLanguages());
        $this->setData('category', $this->categoryModel->getCategoryById($categoryId));
        $this->setData('categories', $this->categoryModel->getCategoriesByResourceType($resourceTypeId, 'ru'));
        return View::make('categories/edit', $this->data);
    }

    public function processCreateCategory()
    {
        $params = Limber\Http\Input::post();
        $categoryId = $this->categoryModel->add($params);
        echo json_encode([
            'redirect_uri' => '/backend/resource/' . $params['resource_type_id'] . '/category/edit/' . $categoryId
        ]);
        exit;
    }

}