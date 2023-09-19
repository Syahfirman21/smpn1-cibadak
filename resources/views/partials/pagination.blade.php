<div class="pagination">
    <ul class="pagination">
        <!-- Tombol navigasi ke halaman sebelumnya -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">
                    <span aria-hidden="true">&laquo;</span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @endif

        <!-- Nomor-nomor halaman -->
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Tombol navigasi ke halaman berikutnya -->
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">
                    <span aria-hidden="true">&raquo;</span>
                </span>
            </li>
        @endif
    </ul>
</div>
