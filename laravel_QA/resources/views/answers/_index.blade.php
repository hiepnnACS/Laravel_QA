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
                        @include('answers._answer')

                    {{-- <hr> --}}

                @endforeach

            </div>
        </div>
    </div>
</div>