@section('head_bottom')
<link rel="stylesheet" href="{{ cd_asset('claremontdesign/cdsurvey') }}/cdsurvey.css" />
<style type="text/css">
	.survey-title-wrapper{
		border-bottom: 1px solid black;
		margin-bottom: 50px;
	}
	.survey-title{}
	.survey-sub-title{
		font-size: 15px !important;
	}
	.survey-widget-question{
		margin-bottom: 100px;
	}
	.survey-question{
		padding: 0 20px;
		font-size: 25px;
	}
	.survey-question-note{
		padding: 0 30px;
		font-size: 13px;
		font-style:italic;
	}
	.survey-answers{
		margin-top:40px;
		padding: 0 40px;
	}
	.survey-answer{}
</style>
@append
<?php
$done = $widget->isDone();
if(empty($done))
{
	$hasSurvey = $widget->hasSurvey();
	$questions = $widget->getPreparedQuestions();
	$survey = $widget->getSurvey();
}
?>
<div <?php echo $widget->getHtmlTagAttributes('widget') ?>>
	<?php if(!$done): ?>
		<?php if($hasSurvey): ?>
			<div class="survey-title-wrapper">
				<h1 class="survey-title"><?php echo $survey->title() ?></h1>
				<h2 class="survey-sub-title"><?php echo $survey->description() ?></h2>
			</div>
			<form role="form" name="widget-survey-form" method="post" id="widget-survey-form-<?php echo $survey->id() ?>" action="">
				<?php foreach ($questions as $question): ?>
					<div class="survey-widget-question">
						<p class="survey-question"><?php echo $question->id() ?>. <?php echo $question->question(); ?></p>
						<?php if($question->hasNote()): ?>
							<p class="survey-question-note"><?php echo $question->note(); ?></p>
						<?php endif; ?>
						<div class="survey-answers">
							<?php foreach ($question->preparedAnswers() as $answer): ?>
								<div class="survey-answer">
									<?php echo $answer->id() ?>. <?php echo $answer->element()->render(); ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Submit" />
				<input type="hidden" value="<?php echo $survey->id() ?>" name="survey[]" />
			</form>
		<?php endif; ?>
	<?php else: ?>
		<div class="jumbotron">
			<h1 class="survey-title">Thank you!</h1>
			<p>Again, thank you very much for participating</p>
		</div>
	<?php endif; ?>
</div>