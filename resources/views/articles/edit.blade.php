@extends('layouts.app')


@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @if($mode == 'edit') 編輯文章 @else 新增文章 @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 控制台</a></li>
            <li><a href="#">文章</a></li>
            <li class="active">@if($mode == 'edit') 編輯文章 @else 新增文章 @endif</li>
        </ol>
    </section>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    @if($mode == 'edit')
                        {{ Form::open(['role'=> 'form', 'route' => ['articles:update', $article->id], 'method' => 'PUT']) }}
                    @else
                        {{ Form::open(['role'=> 'form', 'route' => 'articles:store', 'method' => 'POST']) }}
                    @endif
                        <div class="box-header with-border">
                            <h3 class="box-title">文章</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- text input -->
                            <div class="form-group">
                                <label>{{ trans('validation.attributes.title') }}</label>
                                <input name="title" type="text" class="form-control" placeholder="{{ trans('article.placeholder.title') }}" value="{{ isset($article) ? $article->present()->input('title') : old('title') }}">
                            </div>
                            <!-- select -->
                            <div class="form-group row">
                                <div class="col-xs-4">
                                    <label>{{ trans('validation.attributes.status') }}</label>
                                    <select name="status" class="form-control">
                                        @foreach($statuses as $status_code => $status_name)
                                            <option value="{{ $status_code }}" {{ $mode == 'edit' ? $article->present()->select('status', $status_code) : (old('status') === $status_code ? 'selected' : '') }}>{{ $status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <label>{{ trans('validation.attributes.published_at') }}</label>
                                    <input type="text" name="published_at" class="form-control" placeholder="{{ trans('article.placeholder.published_at') }}" value="{{ isset($article) ? $article->present()->input('published_at') : old('published_at') }}">
                                </div>
                            </div>
                            <!-- textarea -->
                            <div class="form-group">
                                <label>{{ trans('validation.attributes.content') }}</label>
                                <textarea name="content" class="form-control" rows="5" placeholder="{{ trans('article.placeholder.content') }}">{{ isset($article) ? $article->present()->input('content') : old('content') }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection