<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('admins.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="">
                    </a>

                    <p>{{ $post->user->username }}</p>
                    <p>{{ $post->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
        
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else   
        <p class="text-center">No hay posts</p>
    @endif
</div>