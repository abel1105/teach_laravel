@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            文章列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> 控制台</a></li>
            <li><a href="#">文章</a></li>
            <li class="active">文章列表</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">所有文章</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>標題</th>
                                <th style="width: 100px">作者</th>
                                <th style="width: 40px">狀態</th>
                            </tr>
                            @foreach($articles as $index => $article)
                            <tr>
                                <td>{{ $index++ }}.</td>
                                <td><a href="{{ route('articles:edit', $article->id) }}">{{ $article->title }}</a></td>
                                <td>{{ $article->user->name }}</td>
                                <td><span class="badge {{ $article->present()->statusColorClass }}">{{ $article->present()->statusName }}</span></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix text-center">
                        {{ $articles->render() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection