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

            <table class="table-bordered table-striped table my-table">
                <tr>
<!--                    <th>ID</th>-->
                    <th>Ad</a></th>
                    <th>Soyad</a></th>
                    <th>Tarix</a></th>
                    <th>Jurnal</a></th>
                </tr>

                <?php if(isset(ItemsController::$pageData['itemsOnPage'])) {  ?>
                    <?php $paginationList = ItemsController::$pageData['itemsOnPage'] ?>
                    <?php foreach ($paginationList as $list): ?>
                        <tr>
                            <!--                            <td>--><?php //echo $list['id']; ?><!--</td>-->
                            <td onclick="sortAndSavePage('<?php echo $list['first_name']; ?>')">
                                <?php echo $list['first_name']; ?></td>
                            <td ?sort=last_name><?php echo $list['last_name']; ?></td>
                            <td ?sort=last_name><?php echo $list['added_date']; ?></td>
                            <td ?sort=last_name><?php echo $list['journal_id']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </table>


        </div>

        <!-- Pagination links -->
        <div class="pagination">
            <?php echo ItemsController::$pageData['pagination']; ?>
        </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

