<div class="media post">
    <div class="d-flex flex-column counters ">
        <div class="d-flex flex-column counters ">
            <div class="vote">
                <strong>{{ $question->votes_count  }}</strong>{{ Str::plural('vote', $question->votes_count) }}
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
        <div class="expect">{{ $question->excerpt(200) }}</div>
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