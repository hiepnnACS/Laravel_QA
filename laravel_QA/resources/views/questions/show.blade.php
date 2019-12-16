@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                            </div>
                        </div>
                    </div>

                    <hr>

                <div class="media">
                    
                    <div class="d-flex d-flex-column vote-controls">
                        <a title="This question is useful" class="vote-up">
                            <i class="fas fa-caret-up fa-3x"></i>
                        </a>
                        <span class="votes-count">1230</span>
                        <a title="This question is not useful" class="vote-down off" >
                            <i class="fas fa-caret-down fa-3x"></i>
                        </a>
                        <a title="Click to mark as favorite question (Click again to undo) "
                           class="favorite {{ Auth::Guest() ? 'off' : ($question->is_favorited ? 'favorited' : 'off') }} mt-2"
                           onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                            <i class="fas fa-star fa-2x"></i>
                            <span class="favorite-count ">{{ $question->favorites_count }}</span>
                        </a>    
                        <form id="favorite-question-{{ $question->id }}" action="/question/{{ $question->id }}/favorite" method="post" style="display: none" >
                            @csrf
                            @if($question->is_favorited)
                                @method('DELETE')
                            @endif
                        </form>
                    </div>

                    <div class="media-body">
                        {!! $question->body_html !!}

                        <div class="float-right">
                            <span class="text-muted">
                                Answered {{ $question->created_date }}
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img src="{{ $question->user->avatar }}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                   
                </div>
                
            </div>

        </div>
    </div>

    @include('answers._index', [
        'answerCount' => $question->answer_count,
        'answers' => $question->answers
    ]); 

    @include('answers._create')

</div>
@endsection