<div class="container">
	<div class="panel-holder mt-80 mb-40">
		<div class="title-3 mt-0">Обновить фильм</div>
			<form action="edit.php?id=<?=$_GET['id']?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="label">Название фильма
						<input class="input" name="title" type="text" placeholder="Такси 2" id="film_input" value="<?=$film_data['title']?>"/>
						</label>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" id="genre_input" value="<?=$film_data['genre']?>"/></label></div>
						</div>
						<div class="col">
							<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" id="year_input" value="<?=$film_data['year']?>"/></label></div>
						</div>
					</div>
					<textarea name="description" placeholder="Введите описание фильма..." class="textarea"><?=$film_data['description']?></textarea>
					<div class="mb-20">
						<input type="file" name="photo">
					</div>
					<input class="button" type="submit" name="editFilm" value="Обновить"/>
			</form>
	</div>
</div>