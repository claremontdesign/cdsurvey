<?php
$hasSurvey = $widget->hasSurvey();
$questions = $widget->getQuestions();
?>
<div <?php echo $widget->getHtmlTagAttributes('widget') ?>>
	<?php if($hasSurvey): ?>
		<?php foreach ($questions as $question): ?>
			<div class="survey-widget-question">
				<p class="question"><?php echo $question->question(); ?></p>
				<?php foreach ($question->getAnswers() as $answer): ?>
					<?php $widget->answer($answer)->render(); ?>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>