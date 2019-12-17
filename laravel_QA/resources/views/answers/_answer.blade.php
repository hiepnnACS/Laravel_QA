<answer :answer="{{ $answer }}" inline-template>
<div class="media post">
    @include('shared._vote', [
        'model' => $answer
    ])
    
    <div class="media-body">
        <form v-if="editing">
            <div class="form-group">
                <textarea class="form-control" v-model="body" cols="30" rows="10"></textarea>
            </div>
            <button class="btn btn-outline-secondary" type="button" {{-- @click="editing = false"  --}} @click="update">Update</button>
            <button class="btn btn-outline-secondary" @click="editing = false">Cancel</button>
        </form>
        <div v-else>
        <div v-html="bodyHtml"></div>
        <div class="row">
            <div class="col-4">
                <div class="ml-auto">
                    @can('update', $answer)
                        <a @click.prevent="editing = true" class="btn btn-outline-secondary">Edit</a>
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
                {{-- @include('shared._author', [
                    'model' => $answer,
                    'label' => 'answered'
                ]) --}}

                <user-info :model="{{ $answer }}" label="Answer"></user-info>
            </div> 
         </div>
        </div>
    </div>
</div>

</answer>