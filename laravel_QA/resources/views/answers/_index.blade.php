<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="cart-title">
                    <h2>{{ $question->answers_count . " " . Str::plural('answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                
                @include('layouts._messages')

                @foreach($answers as $answer)
                        <div class="media">
                            <div class="d-flex d-flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This question is not useful" class="vote-down off" >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (Click again to undo) " class=" mt-2 {{ $answer->status }}">
                                <i class="fas fa-check fa-2x"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-outline-secondary">Edit</a>
                                        @endcan
                                        {{-- @endif --}}

                                        {{-- @if(Auth::user()->can('delete-question', $question)) --}}
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                
                                                <button type="submit" class="btn btn-outline-danger" onclick="confirm('Bạn có chắc muốn xóa')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                    
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }}
                                        <div class="media mt-2">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                <img src="{{ $answer->user->avatar }}" alt="">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </span>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <hr>

                @endforeach

            </div>
        </div>
    </div>
</div>