<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Universe\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class Universe extends AbstractActionController
{

    public function indexAction()
    {
        /*return array(
            'table' => '<div class="map">' .
            $this->displayUniverse($universe) . '</div>' . $this->displayMenu()
        );*/
    }

    private function displayUniverse(Universe $universe)
    {
        $size = $universe->getSize();
        $output = '<table border="0" cellpadding="0" cellspacing="0" ' .
                        'style="width:' . $size . 'px;' .
                        'height:' . $size . 'px;"><tbody class="' . get_class($universe) .
                        '"><tr>';
        $output .= $this->displayEntity($universe);
        $output .= '</tr></tbody></table>';

        return $output;
    }

    private function displayEntity(DarkMatter $entity)
    {
        $str = '';
        $class = $this->getClass($entity);
        if ($entity instanceof HasSubSpaces) {
            $size = $entity->getSize();
            $subspaces = $entity->getSubSpaces();
            $nbPerRow = $entity->getSubSpacesPerRow();

            $str .= '<td style="width:' . $size . 'px;height:' .
                            $size . 'px;" class="' . $class . '">';

            $str .= '<!-- start children of ' . get_class($entity) . ' -->';
            $str .= '<table border="0" cellpadding="0" cellspacing="0" cols="' .
                            $nbPerRow . '" style="width:' . $size . 'px;height:' .
                            $size . 'px;"><tbody><tr>';

            $i = 0;
            foreach ($subspaces as $subspace) {
                $str .= $this->displayEntity($subspace);
                $i++;
                if ($i % $nbPerRow == 0) {
                    $str .= '</tr><tr>';
                }
            }
            $str .= '</tbody></tr></table>';
            $str .= '<!-- start children of ' . get_class($entity) . ' -->' .
                            '</td>';
        } else {
            $size = $entity->getSize();
            $str .= '<td class="' . $class . ' ' . $entity->getCssClass() .
            '" style="width:' . $size . 'px;height:' . $size . 'px;"></td>';
        }
        return $str;
    }

    private function getClass(DarkMatter $entity)
    {
        $type = get_class($entity);
        $class = 'universe sector parsec artefact';
        switch ($type) {
            case 'Universe\Entity\Universe':
                $class = 'universe';
                break;
            case 'Universe\Entity\Sector':
                $class = 'universe sector';
                break;
            case 'Universe\Entity\Parsec':
                $class = 'universe sector parsec';
                break;
        }
        return $class;
    }

    private function displayMenu()
    {
        $str = '';

        $str .= '<div class="actionMenu"></div>';

        return $str;
    }

}