@extends('layouts.admin')
@section('css')
<link href="{{asset('backend/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/plugins/editor/css/editormd.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
<link href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
	    <li>
	        <a href="{{url('admin')}}">{!! trans('labels.breadcrumb.home') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <a href="{{url('admin/article')}}">{!! trans('labels.breadcrumb.articleList') !!}</a>
	        <i class="fa fa-angle-right"></i>
	    </li>
	    <li>
	        <span>{!! trans('labels.breadcrumb.articleEdit') !!}</span>
	    </li>
	</ul>
</div>
<div class="row margin-top-40">
  <div class="col-md-12">
      <!-- BEGIN SAMPLE FORM PORTLET-->
      <div class="portlet light bordered">
          <div class="portlet-title">
              <div class="caption font-green-haze">
                  <i class="icon-settings font-green-haze"></i>
                  <span class="caption-subject bold uppercase">{!! trans('labels.breadcrumb.articleEdit') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
          </div>
          <div class="portlet-body form">
          		@if (isset($errors) && count($errors) > 0 )
					    <div class="alert alert-danger">
					        <button class="close" data-close="alert"></button>
					        @foreach($errors->all() as $error)
					            <span class="help-block"><strong>{{ $error }}</strong></span>
					        @endforeach
					    </div>
					    @endif
              <form role="form" class="form-horizontal" method="POST" action="{{url('admin/article/'.$article->id)}}" enctype="multipart/form-data">
          		{!! csrf_field() !!}
          		<input type="hidden" name="_method" value="PATCH">
              	<input type="hidden" name="id" value="{{$article->id}}">
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.article.title')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('labels.article.title')}}" value="{{$article->title}}">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="intro">{{trans('labels.article.category_id')}}</label>
                        <div class="col-md-8">
                          <select class="bs-select1 form-control form-filter" data-live-search="true" data-show-subtext="true" name="category_id">
                              @if($categories)
                                @foreach($categories as $v)
                                  <option value="{{$v['id']}}" @if($article->category_id == $v['id']) selected @endif>{{$v['name']}}</option>
                                  @if($v['child'])
                                  @foreach($v['child'] as $val)
                                    <option value="{{$val['id']}}" @if($article->category_id == $val['id']) selected @endif>{{'|-- '.$val['name']}}</option>
                                  @endforeach
                                  @endif
                                @endforeach
                              @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="img">{{trans('labels.article.img')}}</label>
                          <div class="col-md-8">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                      <img src="{{$article->img or asset('backend/img/no-image.png')}}" alt="" /> </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                  <div>
                                      <span class="btn purple btn-file">
                                          <span class="fileinput-new"> Select image </span>
                                          <span class="fileinput-exists"> Change </span>
                                          <input type="file" name="img"> </span>
                                      <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="intro">{{trans('labels.article.intro')}}</label>
                          <div class="col-md-8">
                            <textarea class="form-control" name="intro" rows="5" placeholder="Enter more text">{{$article->intro}}</textarea>
                            <div class="form-control-focus"></div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <div class="col-md-12">
                              <div id="editor"><textarea style="display: none;">{!!$article->content_mark!!}</textarea></div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="intro">{{trans('labels.article.tag')}}</label>
                        <div class="col-md-8">
                          <select class="bs-select form-control form-filter" data-show-subtext="true" name="tag[]" multiple="true">
                              @if($tags)
                                @foreach($tags as $v)
                                  <option value="{{$v->id}}" @if(in_array($v->id, $article->tag)) selected @endif>{{$v->name}}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="new_tag">{{trans('labels.article.tagCreate')}}</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="new_tag" id="new_tag" value="" data-role="tagsinput">
                        </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.article.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn" @if($article->status == config('admin.global.status.active')) checked @endif>
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.article.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn" @if($article->status === config('admin.global.status.audit')) checked @endif>
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.article.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn" @if($article->status == config('admin.global.status.trash')) checked @endif>
                                    <label for="status3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.article.trash.1')}} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-10">
                              <a href="{{url()->previous()}}" class="btn default">{{trans('crud.cancel')}}</a>
                              <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('backend/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('backend/plugins/editor/js/editormd.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script>
  $(function() {
    var editor = editormd('editor',{
      width   : "100%",
      height  : 640,
      syncScrolling : "single",
      toolbarAutoFixed: false,
      gotoLine:false,
      emoji:true,
      saveHTMLToTextarea:true,
      path    : "{{asset('backend/plugins/editor/lib')}}/"
    });

    $(".bs-select").selectpicker({
      iconBase: "fa",
      tickIcon: "fa-check"
    });
    $(".bs-select1").selectpicker({
      iconBase: "fa",
      tickIcon: "fa-check"
    });
  });
</script>
@endsection