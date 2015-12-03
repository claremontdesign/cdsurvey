@extends(cd_template_main())
@section('body_class', '')
@section('meta_title', 'Survey')
@section('meta_keywords', '')
@section('meta_description', '')
@section('body_bottom')
@append
@section('head_bottom')

@append
@section('content')
{!! cd_widget_standalone('surveyAvailable', compact('surveyId')) !!}
@stop