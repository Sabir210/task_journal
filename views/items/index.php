<?php include ROOT . '/views/layouts/header.php'; ?>
<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/items">Jurnal</a></li>
                </ol>
            </div>

<!--            <a href="/items/create" class="btn btn-default back add"><i class="fa fa-plus add"></i> Добавить запись</a>-->

            <h4>Jurnal Axtar</h4>

            <br/>

            <div class="time-interval-form">
                <div class="form">
                    <form action="/items/search">
                        <div style="display: inline-block; margin-right: 10px;">
                            <label for="start">Start Date and Time:</label>
                            <input type="datetime-local" id="start" name="start" required>
                        </div>
                        <div style="display: inline-block; margin-right: 10px;">
                            <label for="end">End Date and Time:</label>
                            <input type="datetime-local" id="end" name="end" required>
                        </div>
                        <div style="display: inline-block; margin-right: 10px;">
                            <input type="text" name="query"  class="form-control form-input" placeholder="Jurnalın nömrəsi">
                        </div>
                        <div style="display: inline-block;">
                            <button type="submit" class="btn btn-primary">Axtar</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            $currentURL = $_SERVER['REQUEST_URI'];

            // Очистка параметров сортировки
            $currentURL = preg_replace('/&?sort=[^&]*/', '', $currentURL);
            $currentURL = rtrim($currentURL, '?');

            ?>

<!--            --><?php //if ($currentURL === '/'): ?>
<!--                <select class="custom-select" onchange="redirectToPage(this.value)">-->
<!--                    <option value="">Сортировка</option>-->
<!--                    <option  value= "--><?php //echo $currentURL . 'itemspagination?page=1&sort=FIRSTNAME_BY_ASC'; ?><!--">Сортировка имени по возрастанию (asc)</option>-->
<!--                    <option value="--><?php //echo $currentURL . 'itemspagination?page=1&sort=FIRSTNAME_BY_DESC'; ?><!--"">Сортировка имени по убыванию (desc)</option>-->
<!--                    <option value="--><?php //echo $currentURL . 'itemspagination?page=1&sort=LASTNAME_BY_ASC'; ?><!--">Сортировка фамилии по возрастанию (asc)</option>-->
<!--                    <option value="--><?php //echo $currentURL . 'itemspagination?page=1&sort=LASTNAME_BY_DESC'; ?><!--">Сортировка фамилии по убыванию (desc)</option>-->
<!--                </select>-->
<!--            --><?php //endif; ?>

            <?php if ($currentURL !== '/'): ?>
            <select class="custom-select" onchange="redirectToPage(this.value)">
                <option value="">Сортировка</option>
                <option  value= "<?php echo $currentURL . '&sort=FIRSTNAME_BY_ASC'; ?>">Сортировка имени по возрастанию (asc)</option>
                <option value="<?php echo $currentURL . '&sort=FIRSTNAME_BY_DESC'; ?>"">Сортировка имени по убыванию (desc)</option>
                <option value="<?php echo $currentURL . '&sort=LASTNAME_BY_ASC'; ?>">Сортировка фамилии по возрастанию (asc)</option>
                <option value="<?php echo $currentURL . '&sort=LASTNAME_BY_DESC'; ?>">Сортировка фамилии по убыванию (desc)</option>
            </select>
            <?php endif; ?>
            <div class="table-items">
                <table class="table-bordered table-striped table my-table">
                <tr>
<!--                    <th>ID</th>-->
                    <th>Ad</a></th>
                    <th>Soyad</a></th>
                    <th>Tarix</a></th>
                    <th>Jurnal</a></th>
                </tr>

                <?php if(isset(SiteController::$pageData['itemsOnPage'])) {  ?>
                    <?php $paginationList = SiteController::$pageData['itemsOnPage'] ?>
                   <?php foreach ($paginationList as $list): ?>
                        <tr>
<!--                            <td>--><?php //echo $list['id']; ?><!--</td>-->
                            <td onclick="sortAndSavePage('<?php echo $list['first_name']; ?>')"> <?php echo $list['first_name']; ?></td>
                            <td ?sort=last_name><?php echo $list['last_name']; ?></td>
                            <td ?sort=last_name><?php echo $list['added_date']; ?></td>
                            <td ?sort=last_name><?php echo $list['journal_id']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </table>
            </div>

        </div>

        <!-- Pagination links -->
        <div class="pagination">
            <?php echo SiteController::$pageData['pagination']; ?>
        </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

