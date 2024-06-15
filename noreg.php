<!doctype html>
<?php session_start(); ?>
<html lang="ru" dir="ltr">
  <head>

    <!-- Обязательные метатеги -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />

    <!-- fancyBox CSS -->
    <link href="/examples/vendors/fancybox/jquery.fancybox.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css\home.css" />
    <title>Главная</title>
    <script type="text/javascript">
        $(function() {
            $(".search_button").click(function() {
                // получаем то, что написал пользователь
                var searchString    = $("#search_box").val();
                // формируем строку запроса
                var data            = 'search='+ searchString;

                // если searchString не пустая
                if(searchString) {
                    // делаем ajax запрос
                    $.ajax({
                        type: "POST",
                        url: "scripts/search.php",
                        data: data,
                        beforeSend: function(html) { // запустится до вызова запроса
                            $("#results").html('');
                            $("#searchresults").show();
                            $(".word").html(searchString);
                       },
                       success: function(html){ // запустится после получения результатов
                            $("#results").show();
                            $("#results").append(html);
                      }
                    });
                }
                return false;
            });
        });


    </script>
         <style>
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 5px;
            float: right; /* Перемещаем форму ввода вправо */
        }

        #searchInput {
            margin-right:8px; /* Добавление отступа снизу к полю ввода */
        }

        

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right; /* Перемещаем кнопку поиска вправо */
        }

        .productlink {
            color: palevioletred;
            transition: color 0.3s;

        }
        #productlink:hover {
            color: violet; /* Цвет ссылки при наведении (фиолетовый) */
        }
        button:hover {
            background-color: #45a049;
        }

        /* Стили для подсветки найденных результатов */
        .highlight {
            background-color: yellow;
        }
    </style>
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="nav-link" href="index.php" style="color: #ffa500; font-size: x-large; font-style: italic;">ComicBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a style="color:black" class="nav-link" href="lk.html">Личный кабинет</a>
                    </li><!-- шрифт -->

                    <li class="nav-item">
                        <a style="color:black" class="nav-link" href="Category\Catalog.html">Каталог</a>
                    </li>
                    <li class="nav-item">

                        <a style="color:black" class="nav-link" href="scripts/index.php">
                            Аккаунт
                            <?php
                            if (empty($_SESSION['login']) or empty($_SESSION['id'])) {

                                echo "(Гость)";
                            } else {
                                echo "(" . $_SESSION['login'] . ")";
                            }
                            ?>
                        </a>



                    </li>

                </ul>
                <div class="pinterest" align="right" onclick="window.open('https://ru.pinterest.com/search/pins/?q=%D0%B3%D0%BE%D1%80%D1%8F%D1%87%D0%B8%D0%B5%20%D1%8F%D0%BF%D0%BE%D0%BD%D1%81%D0%BA%D0%B8%D0%B5%20%D0%B4%D0%B5%D0%B2%D1%83%D1%88%D0%BA%D0%B8&rs=typed')">
                    <img src="https://i.imgur.com/HTftkZ0.png" width="40px" alt="pinterest" />
                </div>

                <div class="pinterest" align="right" onclick="window.open('https://t.me/mangalib_recommendation')">
                    <img src="https://w7.pngwing.com/pngs/402/10/png-transparent-telegram-logo-scalable-graphics-icon-logo-blue-angle-triangle.png" width="40px" alt="telegram" />
                </div>
                <!-- HTML-форма для ввода запроса пользователя -->
                <input 
                    type="text" id="searchInput" placeholder="Поиск..." />
                <button onclick="searchBooks()">Найти</button>

                <!-- Результаты поиска будут отображены здесь -->
                <div id="searchResults"></div>
            </div>
            
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                </nav>



    <!-- Дополнительный JavaScript; выберите один из двух! -->

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Вариант 2: Bootstrap JS отдельно от Popper
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->

    <h1 align="center">Лучшие комиксы</h1>
    <div class="sim-slider" align="center">
        <ul class="sim-slider-list">
            <li><img src="http://pvbk.spb.ru/inc/slider/imgs/no-image.gif" alt="screen" /></li><!--700x437  -->
            <li class="sim-slider-element"><img src="images\33743.jpg" alt="0" style="width: 1000px; height: 500px;" /></li>
            <li class="sim-slider-element"><img src="images\33640.jpg" alt="1" style="width: 1000px; height: 500px;" /></li>
            <li class="sim-slider-element"><img src="images\33956.jpg" alt="2" style="width: 1000px; height: 500px;" /></li>
            <li class="sim-slider-element"><img src="images\33760.jpg" alt="3" style="width: 1000px; height: 500px;" /></li>
            <li class="sim-slider-element"><img src="images\33640.jpg" alt="4" style="width: 1000px; height: 500px;" /></li>
            <li class="sim-slider-element"><img src="images\301189.jpg" alt="5" style="width: 1000px; height: 500px;" /></li>
        </ul>
        <div class="sim-slider-arrow-left"></div>
        <div class="sim-slider-arrow-right"></div>
        <div class="sim-slider-dots"></div>
    </div>
    <h2 align="center">Новинки</h2>

    <p class="thumb" align="center">
   <img src="https://xlm.ru/storage/uploads/images/2022/04/29/0EYraSx2M3r4pLinqVjVNXF1FltLbJuEufPkfkAW-1024x1024.jpeg" alt="Фотография 1" width="250" height="300"> 
   <img src="https://img.newmanga.org/Original/webp/images/projects/2338/dc9b8e8a-d3d3-4836-8236-f71e5a0d8e56.webp" alt="Фотография 2" width="250" height="300">
   <img src="https://cdn.img-gorod.ru/310x500/nomenclature/30/072/3007232-2.jpg" alt="Фотография 3" width="250" height="300">
   <img src="https://img33.imgslib.link//manga/hametsu-no-oukoku/chapters/1704678/01-kopiya_6Urf.png" alt="Фотография 4" width="250" height="300" >
    
  </p>

    <h2 align="center">Лучшие из лучших</h2>

    <div class="container">
        <div class="row row-cols-4">
            <div class="col">
                <a data-fancybox="gallery" href="https://cdn.img-gorod.ru/0x1200/nomenclature/28/694/2869449.jpg"></a>
                
                    <img style="border: solid 2px; border-color: black;" class="thumb" src="https://cdn.img-gorod.ru/0x1200/nomenclature/28/694/2869449.jpg" alt="21" width="250" height="300" />
                </a>
                <p style="font-weight:500" class="lead">Человек-бензопила. Книга 1.</p>
                <p align="left" style="color: orange" class="lead"><strong>876 ₽</strong></p>
                <div align="left">
                    

  <div id="modal" class="modal">
    <div class="modal-content">
      <span style="z-index:999" class="close">&times;</span>
      <p>Пожалуйста, авторизуйтесь на сайте, чтобы продолжить покупку.</p>
      
         <a style="color:black" class="nav-link" href="scripts/index.php">
                            Войти
                            <?php
                            if (empty($_SESSION['login']) or empty($_SESSION['id'])) {

                                echo "(Гость)";
                            } else {
                                echo "(" . $_SESSION['login'] . ")";
                            }
                            ?>
                        </a>
    </div>
  </div>

 
                    <a href="#" class="button" id="buyButton">Купить</a>
                </div>
            </div>
            <div class="col">
                <a data-fancybox="gallery" href="https://www.pulsar.ua/files/img_products/full_Akame-ga-Kill-1.jpg"></a>
               
                    <img style="border: solid 2px; border-color: black;" class="thumb" src="https://www.pulsar.ua/files/img_products/full_Akame-ga-Kill-1.jpg" alt="122" width="250" height="300" />
                </a>
                <p style="font-weight:500" class="lead">Убийца Акаме! Том 1</p>
                <p align="left" style="color: orange" class="lead"><strong>930 ₽</strong></p>
                <div align="left">

                    <a href="#" class="button" >Купить</a>

                </div>
            </div>
            <div class="col">
                <a data-fancybox="gallery" href="https://cdn.img-gorod.ru/0x1200/nomenclature/29/093/2909336.jpg"></a>
               
                    <img style="border: solid 2px; border-color: black;" class="thumb" src="https://cdn.img-gorod.ru/0x1200/nomenclature/29/093/2909336.jpg" alt="121" width="250" height="300" />
                </a>
                <p style="font-weight:500" class="lead">Магическая битва. Том 1</p>
                <p align="left" style="color: orange" class="lead"><strong>840 ₽</strong></p>
                <div align="left">
                    <a href="#" class="button" >Купить</a>
                </div>

            </div>
            <div class="col">
                <a data-fancybox="gallery" href="https://images-na.ssl-images-amazon.com/images/I/811kokwuXdL.jpg"></a>
              
                    <img style="border: solid 2px; border-color: black;" class="thumb" src="https://images-na.ssl-images-amazon.com/images/I/811kokwuXdL.jpg" alt="121" width="250" height="300" />
                </a>
                <p style="font-weight:500" class="lead">HunterxHunter Том 17</p>
                <p align="left" style="color: orange" class="lead"><strong>590 ₽</strong></p>
                <div align="left">
                    <a href="#" class="button" >Купить</a>
                </div>

            </div>
        </div>
        <br />
        <h2 align="center">10 Захватывающих детективов</h2>

        <div class="container">
            <div class="row row-cols-4">
                <div class="col">
                    <a data-fancybox="gallery" href="https://xlm.ru/storage/uploads/images/2021/06/23/2CrKrpDqo9MT04VAmnyTFZOuEL2HIt0WZo6JK5Cp.jpeg"></a>
                   
                        <img style="border: solid 2px; border-color: black;" class="thumb" src="https://xlm.ru/storage/uploads/images/2021/06/23/2CrKrpDqo9MT04VAmnyTFZOuEL2HIt0WZo6JK5Cp.jpeg" alt="21" width="250" height="300" />
                    </a>
                    <p style="font-weight:500" class="lead">Город в котором меня нет</p>
                    <p align="left" style="color: orange" class="lead"><strong>480 ₽</strong></p>
                    <div align="left">
                        <a href="#" class="button" >Купить</a>
                    </div>
                </div>
                <div class="col">
                    <a data-fancybox="gallery" href="https://upload.wikimedia.org/wikipedia/ru/0/04/FugoKeijiBalanceUnlimited_poster.jpg"></a>
                    
                        <img style="border: solid 2px; border-color: black;" class="thumb" src="https://upload.wikimedia.org/wikipedia/ru/0/04/FugoKeijiBalanceUnlimited_poster.jpg" alt="122" width="250" height="300" />
                    </a>
                    <p style="font-weight:500" class="lead">Богатый детектив</p>
                    <p align="left" style="color: orange" class="lead"><strong>510 ₽</strong></p>
                    <div align="left">
                        <a href="#" class="button" >Купить</a>
                    </div>
                </div>
                <div class="col">
                    <a data-fancybox="gallery" href="https://images-na.ssl-images-amazon.com/images/I/71oY4I5ibeL.jpg"></a>
                   
                        <img style="border: solid 2px; border-color: black;" class="thumb" src="https://images-na.ssl-images-amazon.com/images/I/71oY4I5ibeL.jpg" alt="121" width="250" height="300" />
                    </a>
                    <p style="font-weight:500" class="lead">Инцидент кеномо том 1</p>
                    <p align="left" style="color: orange" class="lead"><strong>950 ₽</strong></p>
                    <div align="left">
                        <a href="#" class="button" >Купить</a>
                    </div>

                </div>
                <div class="col">
                    <a data-fancybox="gallery" href="https://images-na.ssl-images-amazon.com/images/I/51OH6f-ua-L.jpg"></a>
                    
                        <img class="thumb" src="https://images-na.ssl-images-amazon.com/images/I/51OH6f-ua-L.jpg" alt="121" width="250" height="300" style="border: 2px solid;" />
                    </a>
                    <p style="font-weight:500" class="lead">Тетрадь смерти Том1</p>
                    <p align="left" style="color: orange" class="lead"><strong>715 ₽</strong></p>
                    <div align="left">
                        <a href="#" class="button" >Купить</a>
                    </div>

                </div>
            </div>
            <br />
            <h2 align="center">Скидки</h2>

            <div class="container">
                <div class="row row-cols-4">
                    <div class="col">
                        <a data-fancybox="gallery" href="https://www.pulsar.ua/files/img_products/full_Black-Clover-2.jpg"></a>
                       
                            <img style="border: solid 2px; border-color: black;" class="thumb" src="https://www.pulsar.ua/files/img_products/full_Black-Clover-2.jpg" alt="21" width="250" height="300" />
                        </a>
                        <p style="font-weight:500" class="lead">Чёрный клевер</p>
                        <p align="left" class="lead" style="text-decoration: line-through; color: orange"><strong>1024 ₽</strong></p>
                        <p align="left" class="lead" style="color: aliceblue"><strong>632 ₽</strong></p>
                        <div align="left">
                            <a href="#" class="button" >Купить</a>
                        </div>
                    </div>
                    <div class="col">
                        <a data-fancybox="gallery" href="https://www.normaeditorial.com/upload/media/albumes/0001/06/thumb_5115_albumes_big.jpeg"></a>
                      
                            <img style="border: solid 2px; border-color: black;" class="thumb" src="https://www.normaeditorial.com/upload/media/albumes/0001/06/thumb_5115_albumes_big.jpeg" alt="122" width="250" height="300" />
                        </a>
                        <p style="font-weight:500" class="lead">Токийский гуль том 14</p>
                        <p align="left" class="lead" style="text-decoration: line-through; color: orange"><strong>802 ₽</strong></p>
                        <p align="left" class="lead" style="color: aliceblue"><strong>574 ₽</strong></p>
                        <div align="left">
                            <a href="#" class="button" >Купить</a>
                        </div>
                    </div>
                    <div class="col">
                        <a data-fancybox="gallery" href="https://cdn.archonia.com/images/1-72957203-1-1-original1/food-wars-vol-32-shokugeki-no-soma-gn-manga.jpg"></a>
                        
                            <img style="border: solid 2px; border-color: black;" class="thumb" src="https://cdn.archonia.com/images/1-72957203-1-1-original1/food-wars-vol-32-shokugeki-no-soma-gn-manga.jpg" alt="121" width="250" height="300" />
                        </a>
                        <p style="font-weight:500" class="lead">В поисках рецепта Том 32</p>
                        <p align="left" class="lead" style="text-decoration: line-through; color: orange"><strong>960 ₽</strong></p>
                        <p align="left" class="lead" style="color: aliceblue"><strong>600 ₽</strong></p>
                        <div align="left">
                            <a href="#" class="button" >Купить</a>
                        </div>

                    </div>
                    <div class="col">
                        <a data-fancybox="gallery" href="https://xlm.ru/storage/uploads/images/2022/04/20/gGGzP8FcsdKKYzI6lhKNpvquiuhZb6MhLhTtpevH.jpeg"></a>
                        
                            <img style="border: solid 2px; border-color: black;" class="thumb" src="https://www.pulsar.ua/files/img_products/full_Nisekoi-1.jpg" alt="121" width="250" height="300" />
                        </a>
                        <p style="font-weight:500" class="lead">Притворная любовь Том 1</p>
                        <p align="left" class="lead" style="text-decoration: line-through; color: orange"><strong>1100 ₽</strong></p>
                        <p align="left" class="lead" style="color: aliceblue"><strong>830 ₽</strong></p>
                        <div align="left">
                            <a href="#" class="button">Купить</a>
                        </div>

                    
               
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    <br />
    <br />
    <br />
    
    <script>
        const buyButton = document.getElementById('buyButton');
const modal = document.getElementById('modal');
const closeButton = document.getElementsByClassName('close')[0];
const loginButton = document.getElementById('loginButton');

buyButton.addEventListener('click', () => {
  modal.style.display = 'block';
});

closeButton.addEventListener('click', () => {
  modal.style.display = 'none';
});

loginButton.addEventListener('click', () => {
  // Здесь можно добавить логику для перенаправления на страницу авторизации
});
    </script>
    <script src="script.js"></script>
    <!-- Footer -->
    <footer class="page-footer font-small indigo">

        <!-- Footer Links -->
        <div class="container">

            <!-- Grid row-->
            <div class="row text-center d-flex justify-content-center pt-5 mb-3">

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">О нас</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Товары</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Адреса магазинов</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Помощь</a>
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 mb-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <a href="#!">Контакты</a>
                    </h6>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->
            <hr class="rgba-white-light" style="margin: 0 15%;" />

            <!-- Grid row-->
            <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

                <!-- Grid column -->
                <div class="col-md-8 col-12 mt-5">
                    <h5 align="center">Добро пожаловать!</h5>
                    <p style="line-height: 1.7rem">«ComicBook» – это сеть книжных в Смоленске и других городах России.
А ещё это удобный интернет-магазин. В нём можно заказывать комиксы разных жанров: триллеры и детективы, фэнтези и фантастику, приключения и романы.
На сайте есть разделы, в которых легко найти интересные новинки, бестселлеры и современную прозу.Выбирайте то, что поднимет настроение!</p>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->
            <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;" />

            <!-- Grid row-->
            <div class="row pb-3">

                <!-- Grid column -->
                <div class="col-md-12">

                    <div class="mb-5 flex-center">

                        <!-- Facebook -->
                        <a class="fb-ic">
                            <i class="fab fa-facebook-f fa-lg white-text mr-4"></i>
                        </a>
                        <!-- Twitter -->
                        <a class="tw-ic">
                            <i class="fab fa-twitter fa-lg white-text mr-4"></i>
                        </a>
                        <!-- Google +-->
                        <a class="gplus-ic">
                            <i class="fab fa-google-plus-g fa-lg white-text mr-4"></i>
                        </a>
                        <!--Linkedin -->
                        <a class="li-ic">
                            <i class="fab fa-linkedin-in fa-lg white-text mr-4"></i>
                        </a>
                        <!--Instagram-->
                        <a class="ins-ic">
                            <i class="fab fa-instagram fa-lg white-text mr-4"></i>
                        </a>
                        <!--Pinterest-->
                        <a class="pin-ic">
                            <i class="fab fa-pinterest fa-lg white-text"></i>
                        </a>

                    </div>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
            © 2023 Copyright:
            <a href="https://mdbootstrap.com/">ComicBook.com</a>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->


    <script type="text/javascript">
        function Sim(sldrId) {

       let id = document.getElementById(sldrId);
       if(id) {
         this.sldrRoot = id
       }
       else {
         this.sldrRoot = document.querySelector('.sim-slider')
       };

       // Carousel objects
       this.sldrList = this.sldrRoot.querySelector('.sim-slider-list');
       this.sldrElements = this.sldrList.querySelectorAll('.sim-slider-element');
       this.sldrElemFirst = this.sldrList.querySelector('.sim-slider-element');
       this.leftArrow = this.sldrRoot.querySelector('div.sim-slider-arrow-left');
       this.rightArrow = this.sldrRoot.querySelector('div.sim-slider-arrow-right');
       this.indicatorDots = this.sldrRoot.querySelector('div.sim-slider-dots');

       // Initialization
       this.options = Sim.defaults;
       Sim.initialize(this)
     };

     Sim.defaults = {

       // Default options for the carousel
       loop: true,     // Бесконечное зацикливание слайдера
       auto: true,     // Автоматическое пролистывание
       interval: 5000, // Интервал между пролистыванием элементов (мс)
       arrows: true,   // Пролистывание стрелками
       dots: true      // Индикаторные точки
     };

     Sim.prototype.elemPrev = function(num) {
       num = num || 1;

       let prevElement = this.currentElement;
       this.currentElement -= num;
       if(this.currentElement < 0) this.currentElement = this.elemCount-1;

       if(!this.options.loop) {
         if(this.currentElement == 0) {
           this.leftArrow.style.display = 'none'
         };
         this.rightArrow.style.display = 'block'
       };

       this.sldrElements[this.currentElement].style.opacity = '1';
       this.sldrElements[prevElement].style.opacity = '0';

       if(this.options.dots) {
         this.dotOn(prevElement); this.dotOff(this.currentElement)
       }
     };

     Sim.prototype.elemNext = function(num) {
       num = num || 1;

       let prevElement = this.currentElement;
       this.currentElement += num;
       if(this.currentElement >= this.elemCount) this.currentElement = 0;

       if(!this.options.loop) {
         if(this.currentElement == this.elemCount-1) {
           this.rightArrow.style.display = 'none'
         };
         this.leftArrow.style.display = 'block'
       };

       this.sldrElements[this.currentElement].style.opacity = '1';
       this.sldrElements[prevElement].style.opacity = '0';

       if(this.options.dots) {
         this.dotOn(prevElement); this.dotOff(this.currentElement)
       }
     };

     Sim.prototype.dotOn = function(num) {
       this.indicatorDotsAll[num].style.cssText = 'background-color:#BBB; cursor:pointer;'
     };

     Sim.prototype.dotOff = function(num) {
       this.indicatorDotsAll[num].style.cssText = 'background-color:#556; cursor:default;'
     };

     Sim.initialize = function(that) {

       // Constants
       that.elemCount = that.sldrElements.length; // Количество элементов

       // Variables
       that.currentElement = 0;
       let bgTime = getTime();

       // Functions
       function getTime() {
         return new Date().getTime();
       };
       function setAutoScroll() {
         that.autoScroll = setInterval(function() {
           let fnTime = getTime();
           if(fnTime - bgTime + 10 > that.options.interval) {
             bgTime = fnTime; that.elemNext()
           }
         }, that.options.interval)
       };

       // Start initialization
       if(that.elemCount <= 1) {   // Отключить навигацию
         that.options.auto = false; that.options.arrows = false; that.options.dots = false;
         that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
       };
       if(that.elemCount >= 1) {   // показать первый элемент
         that.sldrElemFirst.style.opacity = '1';
       };

       if(!that.options.loop) {
         that.leftArrow.style.display = 'none';  // отключить левую стрелку
         that.options.auto = false; // отключить автопркрутку
       }
       else if(that.options.auto) {   // инициализация автопрокруки
         setAutoScroll();
         // Остановка прокрутки при наведении мыши на элемент
         that.sldrList.addEventListener('mouseenter', function() {clearInterval(that.autoScroll)}, false);
         that.sldrList.addEventListener('mouseleave', setAutoScroll, false)
       };

       if(that.options.arrows) {  // инициализация стрелок
         that.leftArrow.addEventListener('click', function() {
           let fnTime = getTime();
           if(fnTime - bgTime > 1000) {
             bgTime = fnTime; that.elemPrev()
           }
         }, false);
         that.rightArrow.addEventListener('click', function() {
           let fnTime = getTime();
           if(fnTime - bgTime > 1000) {
             bgTime = fnTime; that.elemNext()
           }
         }, false)
       }
       else {
         that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
       };

       if(that.options.dots) {  // инициализация индикаторных точек
         let sum = '', diffNum;
         for(let i=0; i<that.elemCount; i++) {
           sum += '<span class="sim-dot"></span>'
         };
         that.indicatorDots.innerHTML = sum;
         that.indicatorDotsAll = that.sldrRoot.querySelectorAll('span.sim-dot');
         // Назначаем точкам обработчик события 'click'
         for(let n=0; n<that.elemCount; n++) {
           that.indicatorDotsAll[n].addEventListener('click', function() {
             diffNum = Math.abs(n - that.currentElement);
             if(n < that.currentElement) {
               bgTime = getTime(); that.elemPrev(diffNum)
             }
             else if(n > that.currentElement) {
               bgTime = getTime(); that.elemNext(diffNum)
             }
             // Если n == that.currentElement ничего не делаем
           }, false)
         };
         that.dotOff(0);  // точка[0] выключена, остальные включены
         for(let i=1; i<that.elemCount; i++) {
           that.dotOn(i)
         }
       }
     };

     new Sim();
    </script>


    <script type="text/javascript">
        window.addEventListener("resize", AutoScale); //Масштабируем страницу при растягивании окна

     AutoScale(); //Масштабируем страницу после загрузки

     function AutoScale()
     {
         let width = window.innerWidth; //Ширина окна
         //Если вы хотите проверять по размеру экрана, то вам нужно свойство window.screen.width

         if(width > 1280)
         {
          ChangeScale("big");
         }
         else if(width <= 1280 && width > 720)
         {
          ChangeScale("normal");
         }
         else if(width < 720)
         {
          ChangeScale("small");
         }
     }
    </script>

    <!-- jQuery -->
    <script src="/examples/vendors/jquery/jquery-3.2.1.min.js"></script>
    <!-- Popper -->
    <script src="/examples/vendors/popper.js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/examples/vendors/bootstrap-4/js/bootstrap.min.js"></script>
    <!-- fancyBox JS -->
    <script src="/examples/vendors/fancybox/jquery.fancybox.min.js"></script>
</body>
</html>

<script src="jquery-3.6.0.min.js"></script>
<script src="bootstrap.js"></script>
<script src="bootstrap.esm.js"></script>

