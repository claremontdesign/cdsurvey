@section('head_bottom')
<link rel="stylesheet" href="{{ cd_asset('css/') }}cdsurvey.css" />
@append
<?php
$done = $widget->isDone();
$hasSurveyId = $widget->hasSurveyId();
$hasSurvey = false;
$questions = $widget->getPreparedQuestions();
$survey = $widget->getSurvey();
if(empty($done) && $hasSurveyId)
{
	$hasSurvey = $widget->hasSurvey();
}
if(!$hasSurveyId)
{
	$surveys = $widget->getAllEnabled();
}
?>
<?php if($hasSurveyId): ?>
	<div <?php echo $widget->getHtmlTagAttributes('widget') ?>>
		<ul class="timeline">
			<li class="timeline-blue">
				<div class="timeline-icon">
					<i class="fa fa-bar-chart-o"></i>
				</div>
				<div class="timeline-body">
					<h2><?php echo $survey->title() ?></h2>
					<div class="timeline-content">
						<?php echo $survey->description(); ?>
					</div>
				</div>
			</li>
		</ul>
		<?php if(!$done): ?>
			<?php if($hasSurvey): ?>
				<form role="form" name="widget-survey-form" method="post" id="widget-survey-form-<?php echo $survey->id() ?>" action="">
					<?php $q = 0; ?>
					<?php foreach ($questions as $question): ?>
						<?php
						$q++;
						?>
						<div id="accordion1" class="survey-question panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 class="panel-title">
										<?php echo cd_paginator_counter($questions, $q); ?>. <?php echo $question->question(); ?>
									</h2>
								</div>
								<div class="panel-collapse collapse in">
									<div class="panel-body">
										<?php if($question->hasNote()): ?>
											<p class="survey-question-note"><?php echo $question->note(); ?></p>
										<?php endif; ?>
										<div class="survey-answers">
											<?php foreach ($question->preparedAnswers() as $answer): ?>
												<div class="survey-answer">
													<?php echo $answer->element()->render(); ?>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<div id="accordion1" class="survey-question panel-group">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" value="Submit" class="btn btn-submit btn-success"/>
						<input type="hidden" value="<?php echo $survey->id() ?>" name="survey[]" />
					</div>
				</form>
			<?php endif; ?>
		<?php else: ?>
			<?php echo $widget->getDoneMessage() ?>
		<?php endif; ?>
	</div>
<?php else: ?>

	<?php if(!empty($surveys)): ?>
		<ul class="timeline">
			<?php foreach ($surveys as $survey): ?>
				<li class="timeline-blue">
					<div class="timeline-icon">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="timeline-body">
						<h2><?php echo $survey->title() ?></h2>
						<div class="timeline-content">
							<?php echo $survey->description(); ?>
						</div>
						<div class="timeline-footer">
							<a href="<?php echo $widget->getSurveyUrl($survey); ?>" class="nav-link pull-left">
								Take the Survey <i class="m-icon-swapright m-icon-white"></i>
							</a>
							<a href="<?php echo $widget->getSurveyResultsUrl($survey); ?>" class="nav-link pull-right">
								View Results <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
<?php endif; ?>