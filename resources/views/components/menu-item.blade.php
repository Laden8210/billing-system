@php
    // Get the last segment of the current URL and convert it to lowercase
    $currentLastSegment = strtolower(last(request()->segments()));
@endphp

<li class="mb-2 p-3 text-gray-500 hover:bg-cyan-100 rounded text-sm
    {{ strtolower($title) === $currentLastSegment ? 'border-l-4 border-cyan-400 bg-cyan-100 font-bold' : '' }}">
    <a href="{{ $url }}" class="flex items-center">

        <div class="flex justify-between items-center">
            <i class="{{ $icon }} pl-1 pr-3"></i>
            {{ $title  }}

        </div>
    </a>
</li>
