@php
    // Get the last segment of the current URL and convert it to lowercase
    $currentLastSegment = strtolower(last(request()->segments()));
@endphp



<li class="nav-item">
    <a class="nav-link " href="{{ $url }}" >
        <i class="{{ $icon }} pl-1 pr-3"></i>
        <span> {{ $title }}</span>
    </a>
</li>
