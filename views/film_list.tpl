<div class="container user-content section-page">
		<div class="title-1">Фильмотека</div>
<?php
    foreach($films as $film) {
?>
       <div class="card mb-20">
           <div class="row">
				<div class="col-auto">
					<img height="200" src="<?=HOST?>/data/films/min/<?=$film['photo']?>" alt="картинка">
				</div>
				<div class="col">
					<div class="class__header">
						<h4 class="title-4"><?=$film["title"]?></h4>
						<?php if( isset($_SESSION['user']) && $_SESSION['user'] == "admin") { ?>
						<div class="buttons">
						   <a href="edit.php?id=<?=$film['id']?>" class="button button--edit">Редактировать</a>
						   <a href="index.php?action=delete&id=<?=$film['id']?>" class="button button--delete">Удалить</a>
						</div>
						<?php } ?>
					</div>

					<div class="badge"><?=$film["genre"]?></div>
					<div class="badge"><?=$film["year"]?></div>
					<div class="mt-20 nb-20">
						<a href="single.php?id=<?=$film['id']?>" class="button">Подробнее</a>
					</div>
				</div>
           </div>
            
		</div>
<?php
    }
?>