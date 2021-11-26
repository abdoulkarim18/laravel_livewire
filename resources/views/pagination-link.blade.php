@if ($paginator->hasPages())

    <ul class="flex justify-between" >

        {{-- Pagination Precedent --}}

        @if ($paginator->onFirstPage())
            <li class="w-18 px-2 py-1 text-center rounded border bg-gray-200">Precedent</li>
        @else
            <li class="w-18 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer"    wire:click="previousPage">Precedent</li>

        @endif
        {{-- Precedent End --}}

        {{-- Numbers --}}

        @foreach ($elements as $page => $url)

        @if($page = $paginator->currentPage())

            <li class="mx-2 w-18 px-2 py-1 text-center rounded border shadow text-white bg-blue-500 cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
        @else
            <li class="mx-2 w-18 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
        @endif

        @endforeach
        {{-- Numbers End --}}

        {{-- Pagination Suivant --}}
        @if ($paginator->hasMorePages())
            <li class="w-18 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="nextPage">Suivant</li>
        @else
            <li class="w-18 px-2 py-1 text-center rounded border bg-gray-200">Suivant</li>
        @endif
        {{-- Suivant End --}}
    </ul>
@endif
