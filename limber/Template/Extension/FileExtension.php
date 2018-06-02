<?php
namespace Limber\Template\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

class FileExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigFileExtensions';
    }

    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('file', array($this, 'getFileLink'))
        ];
    }

    /**
     * @param int $id
     * @return string
     */
    public function getFileLink(int $id)
    {
        $fileModel = new \Modules\Front\Model\File;
        $file = $fileModel->getFileById($id);
        if ($file === null) {
            return '';
        }
        return $file->link;
    }
}