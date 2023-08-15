@extends('backend.layouts.app')

@section('title', '|Edit Post')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Edit Post</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascripit:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @include('backend.posts.form')
        </div>
    </div>
@endsection
