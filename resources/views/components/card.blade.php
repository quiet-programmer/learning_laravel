<div class="card" style="width: 100%">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle">
            {{ $subtitle }}
        </h6>
    </div>

    <ul class="list-group list-group-flush">
        @foreach ($items as $item)
        <li class="list-group-item">
            @if(!isset($show) || $show)
                <a href="{{ route('posts.show', ['post' => $item->id]) }}">
                    {{ $item->$value }}
                </a>
            @else
                {{ $item->$value }}
            @endif
        </li>
        @endforeach
    </ul>
</div>