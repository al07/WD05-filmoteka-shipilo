<h1 class="title-1">Информация о фильме</h1>

<div class="card mb-20">
	<div class="row">
		<div class="col">
			<img src="<?=HOST?>data/films/full/<?=($film_data['photo'] != '') ? $film_data['photo'] : '../zaglushka.png'?>" alt="картинка" class="single_image_class">
		</div>
		<div class="col">
			<h4 class="title-4"><?=$film_data["title"]?></h4>
			<div class="class__header">
				
				<?php if( isset($_SESSION['user']) && $_SESSION['user'] == "admin") { ?>
				<div class="buttons">
				   <a href="edit.php?id=<?=$film_data['id']?>" class="button button--edit">Редактировать</a>
				   <a href="index.php?action=delete&id=<?=$film_data['id']?>" class="button button--delete">Удалить</a>
				</div>
				<?php } ?>
			</div>

			<div class="badge"><?=$film_data["genre"]?></div>
			<div class="badge"><?=$film_data["year"]?></div>
			<div class="user-content">
				<p><?=$film_data['description']?></p>
			</div>
		</div>
	</div>
</div>