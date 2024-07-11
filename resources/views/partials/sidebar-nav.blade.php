<nav class="text-white">
    <div class="flex items-center">
        <div class="site-logo">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-20 w-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>
        <div class="site-text text-2xl font-bold">My HR</div>
    </div>

    <ul class="main-navigation" role="main navigation">
        <x-navigation.menu-item title="Dashboard" dropdown="true" icon='
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />'>
            <li class="child-menuitem pt-2">
                <a href="">HR Dashboard</a>
            </li>
            <li class="child-menuitem pt-2">
                <a href="">Project Dashboard</a>
            </li>
        </x-navigation.menu-item>

        <x-navigation.menu-item title="Projects" dropdown="true" icon='
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />'>
            <li class="child-menuitem pt-2">
                <a href="{{ route('project.index') }}">Projects</a>
            </li>
            <li class="child-menuitem pt-2">
                <a href="">Tasks</a>
            </li>
        </x-navigation.menu-item>

        <x-navigation.menu-item title="Users" dropdown="true" icon='
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />'>
            <li class="child-menuitem pt-2">
                <a href="{{ route('users.index') }}">Users</a>
            </li>
        </x-navigation.menu-item>

    </ul>
</nav>

<script>
function toggleDropdown(element) {
    const collapsedItem = element.nextElementSibling;
    const chevronIcon = element.querySelector('.dropdown-icon svg');

    collapsedItem.classList.toggle('hidden');
    chevronIcon.classList.toggle('rotate-90');

    if (collapsedItem.classList.contains('hidden')) {
        collapsedItem.style.maxHeight = '0';
    } else {
        collapsedItem.style.maxHeight = collapsedItem.scrollHeight + 'px';
    }
}
</script>
