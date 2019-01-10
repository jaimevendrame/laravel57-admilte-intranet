@if ($paginator->hasPages())

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a href="#" class="pagination-back pull-left"></a>
    @else
        <a class="pagination-back pull-left" href="{{ $paginator->previousPageUrl() }}" rel="prev"></a>
    @endif

    <ul class="pages">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="pagination-next pull-right" href="{{ $paginator->nextPageUrl() }}" rel="next"></a>
    @else
        <a class="pagination-next pull-right" href="#" rel="next"></a>
    @endif
@endif
