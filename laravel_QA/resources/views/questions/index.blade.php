@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Question</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    @include('layouts._messages')

                    @foreach($questions as $question)
                        

                        <div class="media">
                            <div class="d-flex flex-column counters ">
                                <div class="d-flex flex-column counters ">
                                    <div class="vote">
                                        <strong>{{ $question->votes  }}</strong>{{ Str::plural('vote', $question->votes) }}
                                    </div>
                                    <div class="status {{ $question->status }}">
                                        <strong>{{ $question->answers_count  }}</strong>{{ Str::plural('answer', $question->answers_count) }}
                                    </div>
                                    <div class="view">
                                        {{ $question->views ."  " . Str::plural('view', $question->views) }}
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                <p class="lead">
                                    Asked by
                                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                {{ Str::limit( $question->body, 200 ) }}
                            </div>
                        

                        <div class="ml-auto justify-content-center">
                            {{-- @if(Auth::user()->can('update-question', $question)) --}}
                            @can('update', $question)
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-outline-secondary">Edit</a>
                            @endcan
                            {{-- @endif --}}

                            {{-- @if(Auth::user()->can('delete-question', $question)) --}}
                            @can('delete', $question)
                                <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-outline-danger" onclick="confirm('Bạn có chắc muốn xóa')">Delete</button>
                                </form>
                            @endcan
                            {{-- @endif --}}

                        </div>
                      
                       
                    </div>
                    <hr>  
                    @endforeach

                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
