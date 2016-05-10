@extends('layouts.admin')
@section('css')
<link href="{{asset('backend/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
      <li>
          <a href="{{url('admin/')}}">{!! trans('labels.breadcrumb.home') !!}</a>
          <i class="fa fa-angle-right"></i>
      </li>
      <li>
          <span>{!! trans('labels.breadcrumb.cateList') !!}</span>
      </li>
  </ul>
</div>
<div class="row margin-top-40">
    <div class="col-md-12">
      @include('flash::message')
        <div class="col-md-6">
          <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
              <div class="caption">
                <i class="icon-settings font-green-sharp"></i>
                <span class="caption-subject font-green-sharp sbold uppercase">{!! trans('labels.breadcrumb.cateList') !!}</span>
              </div>
              <div class="actions">
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
              </div>
            </div>
              <div class="portlet-body">
                  <div class="dd" id="nestable_list">
                      <ol class="dd-list">
                          @if($cate)
                          @foreach($cate as $v)
                          @if($v['child'])
                          <li class="dd-item" data-id="{{$v['id']}}" data-pid="{{$v['pid']}}">
                            <div class="dd-handle dd3-handle"></div>
                              <div class="dd3-content">
                                {{$v['name']}}
                                <div class="pull-right action-buttons">
                                @permission(config('admin.permissions.category.create'))
                                <a href="javascript:;" data-pid="{{$v['id']}}" class="btn-xs tooltips createCate" data-original-title="{{trans('crud.create')}}"  data-placement="top"><i class="fa fa-plus"></i></a>
                                @endpermission
                                @permission(config('admin.permissions.category.edit'))
                                <a href="javascript:;" data-href="{{url('admin/cate/'.$v['id'].'/edit')}}" class="btn-xs tooltips editCate" data-original-title="{{trans('crud.edit')}}"  data-placement="top"><i class="fa fa-pencil"></i></a>
                                @endpermission
                                @permission(config('admin.permissions.category.destory'))
                                <a href="javascript:;" data-id="{{$v['id']}}" class="btn-xs tooltips destoryCate" data-original-title="{{trans('crud.destory')}}"  data-placement="top"><i class="fa fa-trash"></i><form action="{{url('admin/cate/'.$v['id'])}}" method="POST" name="delete_item{{$v['id']}}" style="display:none"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="{{csrf_token()}}"></form></a>
                                @endpermission
                                </div>
                              </div>
                              <ol class="dd-list">
                                  @foreach($v['child'] as $val)
                                  <li class="dd-item" data-id="{{$val['id']}}" data-pid="{{$val['pid']}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                      {{$val['name']}}
                                      <div class="pull-right action-buttons">
                                      @permission(config('admin.permissions.category.edit'))
                                      <a href="javascript:;" data-href="{{url('admin/cate/'.$val['id'].'/edit')}}" class="btn-xs tooltips editCate" data-original-title="{{trans('crud.edit')}}"  data-placement="top"><i class="fa fa-pencil"></i></a>
                                      @endpermission
                                      @permission(config('admin.permissions.category.destory'))
                                      <a href="javascript:;" data-id="{{$val['id']}}" class="btn-xs tooltips destoryCate" data-original-title="{{trans('crud.destory')}}"  data-placement="top"><i class="fa fa-trash"></i><form action="{{url('admin/cate/'.$val['id'])}}" method="POST" name="delete_item{{$val['id']}}" style="display:none"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="{{csrf_token()}}"></form></a>
                                      @endpermission
                                      </div>
                                    </div>
                                  </li>
                                  @endforeach
                              </ol>
                          </li>
                          @else
                              <li class="dd-item" data-id="{{$v['id']}}" data-pid="{{$v['pid']}}">
                                  <div class="dd-handle dd3-handle"></div>
                                  <div class="dd3-content"> 
                                    {{$v['name']}} 
                                    <div class="pull-right action-buttons">
                                    @permission(config('admin.permissions.category.create'))
                                    <a href="javascript:;" data-pid="{{$v['id']}}" class="btn-xs tooltips createCate" data-original-title="{{trans('crud.create')}}"  data-placement="top"><i class="fa fa-plus"></i></a>
                                    @endpermission
                                    @permission(config('admin.permissions.category.edit'))
                                    <a href="javascript:;" data-href="{{url('admin/cate/'.$v['id'].'/edit')}}" class="btn-xs tooltips editCate" data-original-title="{{trans('crud.edit')}}"  data-placement="top"><i class="fa fa-pencil"></i></a>
                                    @endpermission
                                    @permission(config('admin.permissions.category.destory'))
                                    <a href="javascript:;" data-id="{{$v['id']}}" class="btn-xs tooltips destoryCate" data-original-title="{{trans('crud.destory')}}"  data-placement="top"><i class="fa fa-trash"></i><form action="{{url('admin/cate/'.$v['id'])}}" method="POST" name="delete_item{{$v['id']}}" style="display:none"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token" value="{{csrf_token()}}"></form></a>
                                    @endpermission
                                    </div>
                                </div>
                              </li>
                          @endif
                          @endforeach
                          @endif
                      </ol>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="portlet light portlet-fit bordered" id="portlet_cate">
            <div class="portlet-title">
              <div class="caption">
                <i class="icon-settings font-green-sharp"></i>
                <span class="caption-subject font-green-sharp sbold uppercase">{!! trans('labels.menu.detail') !!}</span>
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
                <form role="form" class="form-horizontal" id="cateForm" method="POST" action="{{url('admin/cate')}}">
                  {!! csrf_field() !!}
                  <div class="form-body">
                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="name">{{trans('labels.cate.name')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('labels.cate.name')}}" value="">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="pid">{{trans('labels.cate.pid')}}</label>
                          <div class="col-md-8">
                              <select class="form-control" id="pid" name="pid">
                                  <option value="0">{{trans('labels.cateLevel')}}</option>
                                  @if($categories)
                                  @foreach($categories as $v)
                                  <option value="{{$v['id']}}">{{$v['name']}}</option>
                                  @endforeach
                                  @endif
                              </select>
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                          <label class="col-md-2 control-label" for="sort">{{trans('labels.cate.sort')}}</label>
                          <div class="col-md-8">
                              <input type="text" class="form-control" id="sort" name="sort" placeholder="{{trans('labels.cate.sort')}}" value="">
                              <div class="form-control-focus"> </div>
                          </div>
                      </div>

                      <div class="form-group form-md-line-input">
                        <label class="col-md-2 control-label" for="form_control_1">{{trans('labels.permission.status')}}</label>
                        <div class="col-md-10">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="status1" name="status" value="{{config('admin.global.status.active')}}" class="md-radiobtn">
                                    <label for="status1">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.cate.active.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status2" name="status" value="{{config('admin.global.status.audit')}}" class="md-radiobtn">
                                    <label for="status2">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.cate.audit.1')}} </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="status3" name="status" value="{{config('admin.global.status.trash')}}" class="md-radiobtn">
                                    <label for="status3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> {{trans('strings.cate.trash.1')}} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-2 col-md-10">
                              <button type="submit" class="btn blue">{{trans('crud.submit')}}</button>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript" src="{{asset('backend/plugins/jquery-nestable/jquery.nestable.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/plugins/layer/layer.js')}}"></script>
<script>
$(function() {
  $('#nestable_list').nestable({
    "maxDepth":2
  })
  .on('dragEnd', function(event, item, source, destination, position) {
      var currentItemId = $(item).attr('data-id');
      var currentItemPid = $(item).attr('data-pid');
      var itemParentId = $(item).parent().parent().attr('data-id');
      itemParentId = itemParentId == undefined ? 0:itemParentId;
      if (currentItemPid == itemParentId) {
        return false;
      }
      $.ajax({
        url:'/admin/cate/sort',
        data:{
          currentItemId:currentItemId,
          itemParentId:itemParentId,
        },
        dataType:'json',
        success:function(result) {
          layer.msg(result.msg,{icon: result? 6:5});
        }
      });
  });

  var menuFun = function() {
    var menuAttribute = function(cate) {
      $('#name').val(cate.name);
      $('#pid option[value='+cate.pid+']').attr('selected','true');
      $('#sort').val(cate.sort);
      $('input[type=radio][value='+cate.status+']').attr('checked','true');
      $('#cateForm').attr('action',cate.update);
      $('#cateForm').append('<input type="hidden" name="_method" value="PATCH">');
    };
    return {
      initAttribute : menuAttribute
    }
  }();

  $(document).on('click', '.editCate', function () {
      var url = $(this).attr('data-href');
      $.ajax({
        url:url,
        dataType:'json',
        beforeSend:function() {
          App.blockUI({
              target: '#portlet_cate',
              boxed: true
          });
        },
        success:function(menu) {
          App.unblockUI('#portlet_cate');
          menuFun.initAttribute(menu);
          layer.msg(menu.msg,{icon:6});
        }
      });
  });

  $(document).on('click', '.createCate', function () {
    var pid = $(this).attr('data-pid');
    $('#pid option[value='+pid+']').attr('selected','true').siblings().removeAttr('selected');
  });

  $(document).on('click','.destoryCate',function() {
    var id = $(this).attr('data-id');
    layer.msg('{{trans('alerts.deleteTitle')}}', {
      time: 0, //不自动关闭
      btn: ['{{trans('crud.destory')}}', '{{trans('crud.cancel')}}'],
      icon: 5,
      yes: function(index){
        $('form[name=delete_item'+id+']').submit();
        layer.close(index);
      }
    });
  }); 
});

</script>
@endsection