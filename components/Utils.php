<?php
//
//class Utils
//{
//
//    public function drawPager($totalItems, $perPage) {
//        $pages = ceil($totalItems / $perPage);
//        if(!isset($_GET['page']) || intval($_GET['page']) == 0) {
//            $page = 1;
//        } else if (intval($_GET['page']) > $totalItems) {
//            $page = $pages;
//        } else {
//            $page = intval($_GET['page']);
//        }
//
//
//
//        $pager =  "<nav aria-label='Page navigation'>";
//        $pager .= "<ul class='pagination'>";
//        $pager .= "<li><a href='/itemspagination?page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
//        for($i=2; $i<=$pages-1; $i++) {
//            $pager .= "<li><a href='/itemspagination?page=". $i."'>" . $i ."</a></li>";
//        }
//        $pager .= "<li><a href='/itemspagination?page=". $pages ."' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
//        $pager .= "</ul>";
//
//        return $pager;
//    }
//
//    public function drawPagerSearch($totalItems, $perPage) {
//
//        $pages = ceil($totalItems / $perPage);
//        if(!isset($_GET['page']) || intval($_GET['page']) == 0) {
//            $page = 1;
//        } else if (intval($_GET['page']) > $totalItems) {
//            $page = $pages;
//        } else {
//            $page = intval($_GET['page']);
//        }
//
//        $query = $_GET['query'];
//        $pager =  "<nav aria-label='Page navigation'>";
//        $pager .= "<ul class='pagination'>";
//        $pager .= "<li><a href='/items/search?query={$query}page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
//        for($i=2; $i<=$pages-1; $i++) {
//            $pager .= "<li><a href='/items/search?query={$query}&page=". $i."'>" . $i ."</a></li>";
//        }
//        $pager .= "<li><a href='/items/search?query={$query}page=". $pages ."' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
//        $pager .= "</ul>";
//
//        return $pager;
//    }
//}

class Utils {
    public function drawPager($totalItems, $perPage) {
        $pages = ceil($totalItems / $perPage);
        if (!isset($_GET['page']) || intval($_GET['page']) == 0) {
            $page = 1;
        } else if (intval($_GET['page']) > $pages) {
            $page = $pages;
        } else {
            $page = intval($_GET['page']);
        }

        $pager = "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";

        // Определение начальной и конечной страницы в диапазоне
        $startPage = max(1, $page - 4);
        $endPage = min($startPage + 8, $pages);

        if ($startPage > 1) {
            $pager .= "<li><a href='/itemspagination?page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            $pager .= "<li><a href='/itemspagination?page=" . $i . "'>" . $i . "</a></li>";
        }

        if ($endPage < $pages) {
            $pager .= "<li><a href='/itemspagination?page=" . $pages . "' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
        }

        $pager .= "</ul>";
        $pager .= "</nav>";

        return $pager;
    }

    public function drawPagerSearch($totalItems, $perPage) {
        $pages = ceil($totalItems / $perPage);
        if (!isset($_GET['page']) || intval($_GET['page']) == 0) {
            $page = 1;
        } else if (intval($_GET['page']) > $pages) {
            $page = $pages;
        } else {
            $page = intval($_GET['page']);
        }

        $query = $_GET['query'];
        $pager = "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";

        $startPage = max(1, $page - 4);
        $endPage = min($startPage + 8, $pages);

        if ($startPage > 1) {
            $pager .= "<li><a href='/items/search?query={$query}&page=1' aria-label='Previous'><span aria-hidden='true'>«</span> Начало</a></li>";
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            $pager .= "<li><a href='/items/search?query={$query}&page=" . $i . "'>" . $i . "</a></li>";
        }

        if ($endPage < $pages) {
            $pager .= "<li><a href='/items/search?query={$query}&page=" . $pages . "' aria-label='Next'>Конец <span aria-hidden='true'>»</span></a></li>";
        }

        $pager .= "</ul>";
        $pager .= "</nav>";

        return $pager;
    }
}