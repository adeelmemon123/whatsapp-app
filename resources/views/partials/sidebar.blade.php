@php
    use App\Helpers\SidebarMenu;
    $menuItems = SidebarMenu::menu();
@endphp

<nav
    class="bg-[#121e31] fixed top-0 left-0 w-[60px] md:w-[90px] h-screen py-6 flex flex-col items-center shadow-xl overflow-y-auto overflow-x-hidden scrollbar-none">
    <a href="#" class="mb-6">
        <img src="https://readymadeui.com/readymadeui-short-light.svg" alt="logo" class="w-12 mx-auto" />
    </a>

    <ul class="flex flex-col gap-3">
        @foreach ($menuItems as $item)
            <li class="relative group" data-title="{{ $item['title'] }}">
                <a href="{{ $item['url'] }}"
                    class="relative flex justify-center items-center p-1.5 rounded-lg transition-all duration-300
                          {{ $item['active'] ? 'bg-white text-[#121e31] scale-110' : 'text-white hover:bg-white hover:text-[#121e31] hover:scale-110' }}">
                    @if (!empty($item['path']) && file_exists($item['path']))
                        <span class="w-6 h-6">{!! file_get_contents($item['path']) !!}</span>
                    @endif
                </a>

                @if (!empty($item['children']))
                    <ul
                        class="absolute left-full top-0 ml-2 flex flex-col gap-2 bg-[#121e31] p-2 rounded-lg shadow-lg
                               opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        @foreach ($item['children'] as $child)
                            <li>
                                <a href="{{ $child['url'] }}"
                                    class="relative flex items-center gap-2 px-3 py-2 rounded transition-all duration-300
                                          {{ $child['active'] ? 'bg-white text-[#121e31] scale-105' : 'text-white hover:bg-white hover:text-[#121e31] hover:scale-105' }}">
                                    @if ($child['active'])
                                        <span class="absolute left-0 top-0 bottom-0 w-1 bg-red-600 rounded-r"></span>
                                    @endif
                                    @if (!empty($child['path']) && file_exists($child['path']))
                                        <span class="w-5 h-5">{!! file_get_contents($child['path']) !!}</span>
                                    @endif
                                    <span>{{ $child['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>

    <form id="twofactorform" method="POST" action="{{ route('twofactortoggle') }}">
        @csrf
        <div class="relative mt-5 group inline-block" data-title="Two Factor">
            <input id="switch-3" type="checkbox" class="peer sr-only" name="has_two_factor" value="1"
                {{ old('has_two_factor', auth()->user()->has_two_factor ?? false) ? 'checked' : '' }} />
            <label for="switch-3"
                class="block h-4 w-11 rounded bg-slate-200
                       after:absolute after:-top-1 after:left-0 after:h-6 after:w-6
                       after:rounded-md after:border after:border-gray-300
                       after:bg-white after:transition-all after:content-['']
                       peer-checked:bg-red-700 peer-checked:after:translate-x-full cursor-pointer">
            </label>
        </div>
    </form>

    <form class="mt-6 group relative" method="POST">
        @csrf
        <button type="submit"
            class="relative flex justify-center items-center p-1 rounded-lg text-white transition-all duration-300
                       hover:bg-white hover:text-[#121e31] hover:scale-110">
            {!! file_get_contents(public_path('icons/logout.svg')) !!}
        </button>
    </form>
</nav>

<div id="tooltip-container" class="fixed z-[9999] pointer-events-none"></div>

<script>
    autoSave({
        containerSelector: "#twofactorform",
        url: "{{ route('twofactortoggle') }}",
        method: "POST",
        showErrors: false,
        autoSubmitOnChange: "#switch-3"
    });

    const tooltipContainer = document.getElementById('tooltip-container');

    document.querySelectorAll('.group').forEach(item => {
        const title = item.getAttribute('data-title');
        if (!title) return;
        item.addEventListener('mouseenter', () => {
            tooltipContainer.innerHTML = `
            <div class="bg-gradient-to-r from-red-600 via-red-700 to-red-800 text-white px-4 py-2 rounded shadow-lg text-sm font-semibold">
                ${title}
            </div>
        `;
            const rect = item.getBoundingClientRect();
            tooltipContainer.style.top = `${rect.top + rect.height / 2}px`;
            tooltipContainer.style.left = `${rect.right + 10}px`;
        });
        item.addEventListener('mouseleave', () => {
            tooltipContainer.innerHTML = '';
        });
    });
</script>
