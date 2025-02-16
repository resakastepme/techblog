@if ($paginator->hasPages())
    <div class="row">
        <div class="col-lg-12">
            <nav class="blog-pagination justify-content-center d-flex">
                <ul class="pagination">

                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="ti-angle-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                <span aria-hidden="true"><i class="ti-angle-left"></i></span>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $start = max(1, $paginator->currentPage() - 2);
                        $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
                    @endphp

                    {{-- Always show first page --}}
                    @if ($start > 1)
                        <li class="page-item">
                            <a href="{{ $paginator->url(1) }}" class="page-link">1</a>
                        </li>
                        @if ($start > 2)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @endif

                    {{-- Page Links --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item">
                                <a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endfor

                    {{-- Always show last page --}}
                    @if ($end < $paginator->lastPage())
                        @if ($end < $paginator->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        <li class="page-item">
                            <a href="{{ $paginator->url($paginator->lastPage()) }}"
                                class="page-link">{{ $paginator->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Next">
                                <span aria-hidden="true"><i class="ti-angle-right"></i></span>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link"><i class="ti-angle-right"></i></span>
                        </li>
                    @endif

                    </ul>
            </nav>
        </div>
    </div>
@endif
