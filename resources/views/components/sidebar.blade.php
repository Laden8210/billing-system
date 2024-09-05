<nav class="w-60 h-full p-2 items-center shadow align-middle fixed ">

    <h1 class="text-center font-bold text-xl my-2">Welcome Owner101!</h1>

    <ul class="items-center pt-7">


        <x-menu-item title="Dashboard" icon="fas fa-home" url="{{ route('dashboard') }}" />
        <x-menu-item title="User Account" active="true" icon="fa-solid fa-user-pen" url="{{ route('user') }}" />



        <x-menu-item title="Subscriber Information" icon="fa-solid fa-user-pen" url="{{ route('subscriber') }}" />
        <x-menu-item title="Services" icon="fa-solid fa-truck-fast" url="{{ route('service') }}" />
        <x-menu-item title="Billing" icon="fa-solid fa-file-invoice-dollar" url="{{ route('billing') }}" />
        <x-menu-item title="Payment" icon="fa-solid fa-money-bill" url="{{ route('payment') }}" />
        <x-menu-item title="Reports" icon="fa-solid fa-table-list" url="{{ route('report') }}" />
        <x-menu-item title="Announcement" icon="fa-solid fa-bullhorn" url="{{ route('announcement') }}" />
        <x-menu-item title="Complaints" icon="fa-solid fa-comments" url="{{ route('complaints') }}" />
        <x-menu-item title="Logout" icon="fa-solid fa-right-from-bracket" url="" />
    </ul>

    <p class="text-center self-end bottom-2 absolute left-1/4 text-xs">Date: {{ \Carbon\Carbon::now()->toDateString() }}
    </p>



</nav>
