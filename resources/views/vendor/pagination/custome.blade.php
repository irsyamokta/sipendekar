@if ($paginator->hasPages())
    <div class="flex flex-col items-center">
        <span class="text-xs text-gray-700 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
            Data
        </span>

        <nav aria-label="Page navigation example" class="mt-2">
            <ul class="inline-flex -space-x-px text-sm shadow-md py-2 rounded-lg">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-gray-300 rounded-s-lg dark:bg-meta-4 dark:border-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="pagination-link flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-meta-4 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white rounded-s-lg">Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-gray-300 dark:bg-meta-4 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span aria-current="page"
                                        class="flex items-center justify-center px-3 h-8 text-secondary bg-blue-50 hover:bg-blue-100 hover:text-secondary dark:border-gray-700 dark:bg-white  dark:text-secondary">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                        class="pagination-link flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-meta-4 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="pagination-link flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-meta-4 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white rounded-e-lg">Next</a>
                    </li>
                @else
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-gray-300 rounded-e-lg dark:bg-meta-4 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
