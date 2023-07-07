<?php

/**
 * Класс ItemsController
 */
class ItemsController
{
    public static $pagination;

    public static $pageData = [];
    private $itemsPerPage = 500;


    public function __construct()
    {
        $this->utils = new Utils();
    }

    public function actionCreate()
    {

        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['first_name'] = $_POST['first_name'];
            $options['last_name'] = $_POST['last_name'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['address'] = $_POST['address'];
            $options['city'] = $_POST['city'];
            $options['state'] = $_POST['state'];
            $options['zip_code'] = $_POST['zip_code'];
            $options['country'] = $_POST['country'];
            $options['email'] = $_POST['email'];
            $options['notes'] = $_POST['notes'];

            $errors = false;

            if (!isset($options['first_name']) || empty($options['first_name']) ||
                !isset($options['last_name']) || empty($options['last_name']) ||
                !isset($options['phone_number']) || empty($options['phone_number'])
                ) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {

                $id = Items::createItems($options);

                echo '<script>';
                echo 'window.history.go(-2);';
                echo '</script>';
            }
        }

        require_once(ROOT . '/views/items/create.php');
        return true;
    }


    public function actionUpdate($id)
    {
        $items = Items::getItemsById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {

            $options['first_name'] = $_POST['first_name'];
            $options['last_name'] = $_POST['last_name'];
            $options['phone_number'] = $_POST['phone_number'];
            $options['address'] = $_POST['address'];
            $options['city'] = $_POST['city'];
            $options['state'] = $_POST['state'];
            $options['zip_code'] = $_POST['zip_code'];
            $options['country'] = $_POST['country'];
            $options['email'] = $_POST['email'];
            $options['notes'] = $_POST['notes'];


            if (Items::updateItemsById($id, $options)) {
            }

            echo '<script>';
            echo 'window.history.go(-2);';
            echo '</script>';
        }

        // Подключаем вид
        require_once(ROOT . '/views/items/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        if (isset($_POST['submit'])) {

            Items::deleteItemsById($id);

            echo '<script>';
            echo 'window.history.go(-2);';
            echo '</script>';
        }

        // Подключаем вид
        require_once(ROOT . '/views/items/delete.php');
        return true;
    }

    public function actionSearch()
    {


        $allItems = Items::getCountOfSearchedItems();

        $totalPages = ceil($allItems / $this->itemsPerPage);

        $this->makeItemsPager($allItems, $totalPages);

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

        $pagination = $this->utils->drawPagerSearch($allItems, $this->itemsPerPage);
        self::$pageData['pagination'] = $pagination;

        require_once(ROOT . '/views/search/index.php');
        return true;

    }

    public function makeItemsPager($allItems, $totalPages) {
        if(!isset($_GET['page']) || intval($_GET['page']) == 0 || intval($_GET['page']) == 1 || intval($_GET['page']) < 0) {
            $pageNumber = 1;
            $leftLimit = 0;
            $rightLimit = $this->itemsPerPage; // 0-5
        } elseif (intval($_GET['page']) > $totalPages || intval($_GET['page']) == $totalPages) {
            $pageNumber = $totalPages;
            $leftLimit = $this->itemsPerPage * ($pageNumber - 1);
            $rightLimit = $allItems;
        } else {
            $pageNumber = intval($_GET['page']);
            $leftLimit = $this->itemsPerPage * ($pageNumber-1);
            $rightLimit = $this->itemsPerPage;
        }

        self::$pageData['itemsOnPage'] = Items::getLimitSearchItems($leftLimit, $rightLimit);
    }
}
