@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <nav class="nav flex-column">
  <a class="nav-link active" href="#">Active</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled" href="#">Disabled</a>
  <a class="nav-link disabled" href="#">Disabled</a>
  <a class="nav-link disabled" href="#">Disabled</a>
  <a class="nav-link disabled" href="#">Disabled</a>
  <a class="nav-link disabled" href="#">Disabled</a>
  <a class="nav-link disabled" href="#">Disabled</a>
</nav>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header top-question">
                    <div class="d-flex align-items-center">
                        <h2 class="title-top-question">Top Question</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    @include('layouts._messages')

                    @forelse($questions as $question)
                        @include('questions._excerpt') 

                    @empty 
                        <div class="alert alert-warning"><strong>Sorry</strong></div>
                    @endforelse

                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
