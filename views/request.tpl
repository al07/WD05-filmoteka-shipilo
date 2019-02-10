<div class="container">
	<h1 class="title-1">Добавить новый фильм</h1>

	<div class="panel-holder mt-80 mb-40">
		<div class="title-3 mt-0">Добавить фильм</div>
			<form action="request.php" method="POST">
					<div class="form-group">
						<label class="label">Ваше имя
						<input class="input" name="user-name" type="text" placeholder="Ваше имя" id="film_input"/>
						</label>
					</div>
					<div class="form-group">
						<label class="label">Ваш город<input class="input" name="user-city" type="text" placeholder="Ваш город" id="genre_input"/></label>
					</div>
					<input class="button" type="submit" name="user-submit" value="Сохранить"/>
			</form>
	</div>
</div>