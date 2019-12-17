@if($model instanceof App\Question)
    @php
        $name = "questions";
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)
    @php 
        $name = 'answers';
        $firstURISegment = 'answers';
    @endphp
@endif
@php
    $formId = $name . '-' . $model->id;
    $formAction =  "/{$firstURISegment}/{$model->id}/vote";
@endphp

<div class="d-flex d-flex-column vote-controls">
    <a title="This {{ $name }} is useful" 
       class="vote-up {{ Auth::Guest() ? 'off' : '' }}" 
       onclick="event.preventDefault(); 
                document.getElementById('up-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $formId }}" 
          action="{{ $formAction }}" 
          method="post">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>

    <span class="votes-count">{{ $model->votes_count }}</span>

    <a title="This {{ $name }} is not useful" 
       class="vote-down {{ Auth::Guest() ? 'off' : '' }}"  
       onclick="event.preventDefault();
                document.getElementById('down-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form method="post" id="down-vote-{{ $formId }}" action="{{ $formAction }}">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    
    @if($model instanceof App\Question)
        @include('shared._favorite', [
            'model' => $model
        ])
    @elseif($model instanceof App\Answer)
        @include('shared._accept', [
            'model' => $model
        ])
    @endif

</div>