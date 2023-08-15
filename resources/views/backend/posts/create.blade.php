@extends('backend.layouts.app')

@section('title', '|Create Post')

@section('breadcrumb')
    <div class="page-header">
        <h1 class="page-title">Create Post</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascripit:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Post</li>
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
