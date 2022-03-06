<div x-data="{ show:false }">
    {{-- Trigger --}}
    <div @click="show = ! show" @click.away="show = false">
        {{ $trigger }}
    </div>

    {{-- Dropdown --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl z-50" style="display: none">
        {{ $slot }}
    </div>
</div>
