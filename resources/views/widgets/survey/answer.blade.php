@section('head_bottom')
<link rel="stylesheet" href="{{ cd_asset('css/') }}cdsurvey.css" />
@append
<?php
$hasResult = $widget->hasResult();
$hasSurvey = $widget->hasSurvey();
$questions = $widget->getPreparedQuestions();
$survey = $widget->getSurvey();
$result = $widget->getResult();
if($hasResult)
{
	$customer = $result->customer()->first();
}
?>
<?php if($hasResult): ?>
	<div <?php echo $widget->getHtmlTagAttributes('widget') ?>>
		<?php if($hasSurvey): ?>
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

			<?php $q = 0; ?>
			<?php foreach ($questions as $question): ?>
		<?php $q++;?>
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
		<?php endif; ?>
	</div>
<?php endif; ?>