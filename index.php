<?php
// Соединяемся с базой данных и делаем проверку на ошибки соединения
	$link = mysqli_connect('localhost', 'mysql', 'mysql', 'filmoteka');

	if(mysqli_connect_error()) {
		die("Произошла ошибка соединения с базой данных!");
    }
#######################################################################    
// Сохраняем данные из формы в базу данных
    if(array_key_exists('newFilm', $_POST)) {
//  Готовим запрос для БД
        $query = "INSERT INTO cinema (title, genre, year) VALUES (
        '" . mysqli_real_escape_string($link, $_POST['title']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['genre']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['year']) . "'
        )";
// Отправляем запрос. Проверку на итог выполненного действия разместил в блоке 
// <div class="panel-holder mt-80 mb-40"></div>

    $result = mysqli_query($link, $query);    
    //     if($result) {
    //         echo "<p>Фильм добавлен!</p>";
    //     } else {
    //         echo "<p>Не удалось добавить фильм!</p>";
    //     }
    // }
    }
#######################################################################    
/* Подготавливаем запрос на выборку данных из БД */   
	$query = "SELECT * FROM cinema";
    $films = [];    
/* Отправляем запрос */    
    $prompt = mysqli_query($link, $query);

    if ( $prompt) {
        // Сохраняем в массив полученные данные из БД и прокручиваем через цикл
        //Функция (mysqli_fetch_array) в цикле достает данные построчно из БД
				while($row = mysqli_fetch_array($prompt)) {
					$films[] = $row; 
				}
			}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<title>[Имя и фамилия] - Фильмотека</title>
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"/><![endif]-->
	<meta name="keywords" content="" />
	<meta name="description" content="" /><!-- build:cssVendor css/vendor.css -->
	<link rel="stylesheet" href="libs/normalize-css/normalize.css" />
	<link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css" />
	<link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css" /><!-- endbuild -->
	<!-- build:cssCustom css/main.css -->
	<link rel="stylesheet" href="./css/main.css" /><!-- endbuild -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
	<!--[if lt IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
</head>

<body class="index-page">
	<div class="container user-content section-page">
        <div class="title-1">Фильмотека</div>
<!-- Вытаскиваем из массива данные заполненного ими ранее циклом while и передаем их в раздел "Фильмотека"-->
            <?php
                foreach($films as $key => $value) {
            ?>
		<div class="card mb-20">
			<h4 class="title-4"><?= $value['title'] ?></h4>
			<div class="badge"><?= $value['genre'] ?></div>
			<div class="badge"><?= $value['year'] ?></div>
        </div>

            <?php
                }
            ?>    

        <div class="panel-holder mt-80 mb-40">
<!-- проверяем запрос на итог выполненного действия -->
            <?php
                if($result) {
                    echo "<p>Фильм добавлен!</p>";
                } else {
                    echo "<p>Не удалось добавить фильм!</p>";
                }
            ?>
			<div class="title-3 mt-0">Добавить фильм</div>
			<form action="index.php" method="POST">
				<div class="notify notify--error mb-20">Название фильма не может быть пустым.</div>
				<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Такси 2" /></label></div>
				<div class="row">
					<div class="col">
						<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" /></label></div>
					</div>
					<div class="col">
						<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" /></label></div>
					</div>
				</div><input class="button" type="submit" name="newFilm" value="Добавить" />
			</form>
		</div>
	</div><!-- build:jsLibs js/libs.js -->
	<script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
	<!-- build:jsVendor js/vendor.js -->
	<script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIr67yxxPmnF-xb4JVokCVGgLbPtuqxiA"></script><!-- endbuild -->
	<!-- build:jsMain js/main.js -->
	<script src="js/main.js"></script><!-- endbuild -->
	<script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>

</html>