<?php

/**
 * Класс SiteController
 */
class SiteController
{

    public static $pagination;

    public static $pageData = [];

    private $itemsPerPage = 2000;

    public function __construct()
    {
        $this->utils = new Utils();
    }

    public function actionIndex()
    {
        $allItems = Items::getCountofAllItems();
        $totalPages = ceil($allItems / $this->itemsPerPage);

        $this->makeItemsPager($allItems, $totalPages);

        $pagination = $this->utils->drawPager($allItems, $this->itemsPerPage);
        self::$pageData['pagination'] = $pagination;

        $sort = 'FIRSTNAME_BY_ASC';

        if(isset($_GET['sort'])) {
            if ($_GET['sort'] == 'FIRSTNAME_BY_ASC') {
                $sortByFirstNameAsc = function ($a, $b) {
                    return strcmp($a['first_name'], $b['first_name']);
                };
                usort(self::$pageData['itemsOnPage'], $sortByFirstNameAsc);

            } else if ($_GET['sort'] == 'FIRSTNAME_BY_DESC') {
                $sortByFirstNameDesc = function ($a, $b) {
                    return strcmp($b['first_name'], $a['first_name']);
                };
                usort(self::$pageData['itemsOnPage'], $sortByFirstNameDesc);
            } else if ($_GET['sort'] == 'LASTNAME_BY_ASC') {
                $sortByLastNameAsc = function ($a, $b) {
                    return strcmp($a['last_name'], $b['last_name']);
                };
                usort(self::$pageData['itemsOnPage'], $sortByLastNameAsc);
            } else if ($_GET['sort'] == 'LASTNAME_BY_DESC') {
                $sortByLastNameDesc = function ($a, $b) {
                    return strcmp($b['last_name'], $a['last_name']);
                };
                usort(self::$pageData['itemsOnPage'], $sortByLastNameDesc);
            }
        }

//        $sort = $_GET['sort'];
//        echo $sort;
//        if(isset($sort) && $sort = 'lastname') {
//            self::$pageData['itemsOnPage'] = array_reverse(self::$pageData['itemsOnPage']);
//        } else if(isset($sort) && $sort = 'firstname') {
//            self::$pageData['itemsOnPage'];
//        }


        require_once (ROOT . '/views/items/index.php');
        return true;
    }

    public function makeItemsPager($allItems, $totalPages) {
        if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->itemsPerPage;
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages; // 2
            $leftLimit = $this->itemsPerPage * ($pageNumber - 1);
            $rightLimit = $allItems; // 8
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->itemsPerPage * ($pageNumber-1);
            $rightLimit = $this->itemsPerPage;
        }

        self::$pageData['itemsOnPage'] = Items::getLimitItems($leftLimit, $rightLimit);
    }

    public function actionIndexisite()
    {

    }

}
