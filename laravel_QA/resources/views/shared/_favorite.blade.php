<a title="Click to mark as favorite {{ $name }} (Click again to undo) "
class="favorite {{ Auth::Guest() ? 'off' : ($model->is_favorited ? 'favorited' : 'off') }} mt-2"
onclick="event.preventDefault(); document.getElementById('favorite-{{ $name }}-{{ $model->id }}').submit()">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorite-count ">{{ $model->favorites_count }}</span>
</a>    
<form id="favorite-{{ $name }}-{{ $model->id }}" action="/{{ $name }}/{{ $model->id }}/favorite" method="post" style="display: none" >
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>