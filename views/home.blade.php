@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <div class="container">
        <div class="page-container">
            <div class="page-container-content">
                @if($message)
                    <div class="card">
                        <div class="card-body">
                            {{ $message }}
                        </div>
                    </div>
                @endif
                <h1 class="page-container-title">{{ trans('theme::theme.news_title') }}</h1>
                    <div class="row row-cols-md-3 g-3">
                    @foreach($posts as $post)
                            <div class="col">
                                <div class="card">
                                    @if($post->hasImage())
                                        <img class="card-img-top" src="{{ $post->imageUrl() }}"
                                             alt="{{ $post->title }}">
                                    @endif
                                    <div class="card-body">
                                        <h3 class="card-title"><a
                                                href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
                                        <p class="post-text">{{ Str::limit(strip_tags($post->content), 250) }}</p>
                                        <a class="btn btn-primary float-end"
                                           href="{{ route('posts.show', $post) }}">{{ trans('messages.posts.read') }}</a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
