    <div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2023</p>
                <p class="pull-right">Sabir Mammadli</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->


    <script>
        function sortAndSavePage(firstName) {
            // Получаем текущий URL страницы
            var currentPageUrl = window.location.href;

            // Добавляем параметр в ссылку
            var newUrl = currentPageUrl + '?sort=first_name';

            // Сохраняем страницу с новой ссылкой
            window.location.href = newUrl;
        }

        function redirectToPage(selectedOption) {
            if (selectedOption !== "") {
                window.location.replace(selectedOption);
            }
        }
    </script>
<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/main.js"></script>
</body>
</html>