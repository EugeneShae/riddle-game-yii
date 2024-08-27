<?php

/** @var yii\web\View $this */
/** @var app\widgets\RiddleWidget $riddle */

use yii\widgets\Pjax;

$this->title = 'Riddle Game';
?>

<div class="site-index">

	<div class="jumbotron text-center bg-transparent mt-5 mb-5">
		<h1 class="display-4">Welcome to Riddle Game!</h1>

		<p class="lead">You can play a simple riddle game here.</p>
		<!-- Description and rules -->
		<p>Click on the box to open it. If you find the same content in the box, you win😊!</p>
	</div>

	<div class="body-content">
        <?= $riddle->run() ?>
	</div>
</div>
