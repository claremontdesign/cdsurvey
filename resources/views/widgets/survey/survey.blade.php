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
	.survey-question{
		margin: 0 0 15px 5%;
	}
	.survey-question-note{
		padding: 0 30px;
		font-size: 13px;
		font-style:italic;
	}
	.survey-answers{
		margin-top:20px;
		padding: 0 40px;
	}
	.survey-answer{}
	/***
Timeline UI Base
***/
	.timeline {
		margin: 0;
		padding: 0;
		list-style: none;
		position: relative;
	}

	/* The line */
	.timeline:before {
		content: '';
		position: absolute;
		top: 0;
		bottom: 0;
		width: 0px;
		background: #ccc;
		left: 20%;
		margin-left: -10px;
	}

	.timeline > li {
		position: relative;
	}

	/* The date/time */
	.timeline > li .timeline-time {
		display: block;
		width: 15%;
		text-align: right;
		position: absolute;
	}

	.timeline > li .timeline-time span {
		display: block;
		text-align: right;
	}

	.timeline > li .timeline-time span.date {
		font-size: 12px;
		color: #aaa;
		display: block;
		font-weight: 300;
	}

	.timeline > li .timeline-time span.time {
		font-weight: 300;
		font-size: 38px;
		line-height: 38px;
	}

	/* Right content */

	.timeline > li .timeline-body {
		margin: 0 0 15px 5%;
		color: #fff;
		padding: 10px;
		font-weight: 300;
		position: relative;
		border-radius: 5px;
	}

	.timeline > li .timeline-body h2 {
		margin-top: 0px;
		padding: 0 0 5px 0;
		border-bottom: 1px solid rgba(255,255,255,0.3);
		font-size: 24px;
	}

	.timeline > li .timeline-content {
		font-size: 14px;
	}

	.ie8 .timeline > li .timeline-body h2 {
		border-bottom: 1px solid #eee;
	}

	.timeline > li .timeline-body img.timeline-img {
		width: 75px;
		height: 75px;
		margin: 5px 10px 0 0px;
	}

	.timeline > li .timeline-body img.pull-right {
		margin-left: 10px;
	}


	.timeline > li .timeline-body a.nav-link {
		display: inline-block;
		margin-top: 10px;
		color: #fff;
		font-size: 14px;
		padding: 0px;
		text-align: left;
		text-decoration: none;
	}

	.timeline > li .timeline-body a.nav-link:hover {
		opacity: 0.5;
		filter: alpha(opacity=50);
	}

	.timeline > li .timeline-body .btn {
		margin-top: 10px;
	}

	/* The triangle */
	.timeline > li .timeline-body:after {
		right: 100%;
		border: solid transparent;
		content: " ";
		height: 0;
		width: 0;
		position: absolute;
		pointer-events: none;
		border-right-color: #3594cb;
		border-width: 10px;
		top: 19px;
	}

	.timeline > li .timeline-content:after,
	.timeline > li .timeline-content:before {
		display: table;
		line-height: 0;
		content: "";
	}

	.timeline > li .timeline-content:after {
		clear: both;
	}

	.timeline >li .timeline-footer:after,
	.timeline >li .timeline-footer:before {
		content: "";
		display: table;
		line-height: 0;
	}

	.timeline >li .timeline-footer:after {
		clear: both;
	}

	/* The icons */
	.timeline > li .timeline-icon {
		width: 40px;
		height: 40px;
		speak: none;
		font-style: normal;
		font-weight: normal;
		font-variant: normal;
		text-transform: none;
		font-size: 1.4em;
		line-height: 40px;
		-webkit-font-smoothing: antialiased;
		position: absolute;
		color: #fff;
		background: #aaa;
		border-radius: 50%;
		box-shadow: 0 0 0 8px #ccc;
		text-align: center;
		left: 2%;
		top: 20px;
		margin: 5px 0 0 -25px;
		padding-bottom: 3px;
		padding-right: 1px;
		padding-left: 2px;
		-webkit-border-radius: 30px !important;
		-moz-border-radius: 30px !important;
		border-radius: 30px !important;
	}

	.timeline > li .timeline-icon > i {
		font-size: 18px;
	}

	/* Red */
	.timeline li.timeline-red .timeline-body:after {
		border-right-color: #e02222;
	}

	.timeline li.timeline-red .timeline-body {
		background: #e02222;
	}

	.timeline li.timeline-red .timeline-time span.time {
		color: #e02222;
	}

	/* Yellow */
	.timeline li.timeline-yellow .timeline-body:after {
		border-right-color: #ffb848;
	}

	.timeline li.timeline-yellow .timeline-body {
		background: #ffb848;
	}

	.timeline li.timeline-yellow .timeline-time span.time {
		color: #ffb848;
	}

	/* Green */
	.timeline li.timeline-green .timeline-body:after {
		border-right-color: #35aa47;
	}

	.timeline li.timeline-green .timeline-body {
		background: #35aa47;
	}

	.timeline li.timeline-green .timeline-time span.time {
		color: #35aa47;
	}

	/* Blue */
	.timeline li.timeline-blue .timeline-body:after {
		border-right-color: #4b8df8;
	}

	.timeline li.timeline-blue .timeline-body {
		background: #4b8df8;
	}

	.timeline li.timeline-blue .timeline-time span.time {
		color: #4b8df8;
	}

	/* Purple */
	.timeline li.timeline-purple .timeline-body:after {
		border-right-color: #852b99;
	}

	.timeline li.timeline-purple .timeline-body {
		background: #852b99;
	}

	.timeline li.timeline-purple .timeline-time span.time {
		color: #852b99;
	}

	/* Grey */
	.timeline li.timeline-grey .timeline-body:after {
		border-right-color: #555555;
	}

	.timeline li.timeline-grey .timeline-body {
		background: #555555;
	}

	.timeline li.timeline-grey .timeline-time span.time {
		color: #555555;
	}

	@media (max-width: 767px) {
		timeline > li .timeline-time span.time {
			font-size: 18px;
		}

		.timeline:before {
			display: none;
		}

		.timeline > li .timeline-time {
			width: 100%;
			position: relative;
			padding: 0 0 20px 0;
		}

		.timeline > li .timeline-time span {
			text-align: left;
		}

		.timeline > li .timeline-body {
			margin: 0 0 30px 0;
			padding: 1em;
		}

		.timeline > li .timeline-body:after {
			right: auto;
			left: 20px;
			top: -20px;
		}

		.timeline > li .timeline-icon {
			position: relative;
			float: right;
			left: auto;
			margin: -55px 5px 0 0px;
		}

		/*colors*/


		.timeline li.timeline-red .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #e02222;
		}

		.timeline li.timeline-blue .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #4b8df8;
		}

		.timeline li.timeline-green .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #35aa47;
		}

		.timeline li.timeline-yellow .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #ffb848;
		}

		.timeline li.timeline-purple .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #852b99;
		}

		.timeline li.timeline-grey .timeline-body:after {
			border-right-color: transparent;
			border-bottom-color: #555555;
		}
	}

</style>
@append
<?php
$done = $widget->isDone();
$hasSurveyId = $widget->hasSurveyId();
if(empty($done) && $hasSurveyId)
{
	$hasSurvey = $widget->hasSurvey();
	$questions = $widget->getPreparedQuestions();
	$survey = $widget->getSurvey();
}
if(!$hasSurveyId)
{
	$surveys = $widget->getAllEnabled();
}
?>
<?php if($hasSurveyId): ?>
	<div <?php echo $widget->getHtmlTagAttributes('widget') ?>>
		<?php if(!$done): ?>
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


				<form role="form" name="widget-survey-form" method="post" id="widget-survey-form-<?php echo $survey->id() ?>" action="">
					<?php $q = 0; ?>
					<?php foreach ($questions as $question): ?>

						<div id="accordion1" class="survey-question panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 class="panel-title">
										<?php echo $question->id() ?>. <?php echo $question->question(); ?>
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
			<div class="jumbotron">
				<h1 class="survey-title">Thank you!</h1>
				<p>Again, thank you very much for participating</p>
			</div>
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
							<a href="<?php echo $widget->getSurveyUrl($survey); ?>" class="nav-link pull-right">
								Take the Survey <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
<?php endif; ?>