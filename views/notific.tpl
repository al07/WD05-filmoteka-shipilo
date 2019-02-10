<div class="container">
	<?php if (@$resultSuccess != '') { ?>
	   <div class="info-success"><?=$resultSuccess ?></div>
	<?php } ?>
	<?php if (@$resultError != '') { ?>
	   <div class="notify notify--error"><?=$resultError ?></div>
	<?php } ?>


	<?php if ( count(@$errors) ) { ?>
	<div class="container">
		<br>
	<?php foreach($errors as $error) { ?>
		<div class="notify notify--error mb-20" id="<?=$error[1]?>"><?=$error[0]?></div>
	<?php } ?>
	</div>
	<?php } ?>
</div>