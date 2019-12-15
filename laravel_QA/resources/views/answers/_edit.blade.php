@extends('layouts.app')

@section('content')

<div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="cart-title">
                        <h2>Edit Your Answer for <strong>{{ $question->title }}</strong></h2>
                    </div>
                    <hr>
                        <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('body') ? 'is-in  valid' : ''}}" name="body" id="" cols="120" rows="10">{{ old('body', $answer->body) }}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection