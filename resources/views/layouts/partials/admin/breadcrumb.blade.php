@if (count($breadcrumbs))
    <nav class="mb-4">
        <ul class="flex flex-wrap">
            @foreach ($breadcrumbs as $item)
                <li class="text-sm leading-normal text-slate-700 {{ !$loop->first ? "pl-2 before:float-left before:pr-2 before:content-['/']" : ''}}">
                    @isset($item['route'])
                        <a href="{{ $item['route'] }}" class="opacity-50 {{ $item['class'] ?? '' }}">
                            {{ $item['name'] }}
                        </a>
                    @else
                        <span class="{{ $item['class'] ?? '' }}">
                            {{ $item['name'] }}
                        </span>
                    @endisset
                </li>
            @endforeach
        </ul>
        @if (count($breadcrumbs) > 1)
            <h6  class="font-bold {{ $lastItem['class'] ?? 'text-gray-900 dark:text-white' }}">
                {{ end($breadcrumbs)['name'] }}
            </h6>
        @endif
    </nav>
@endif
