<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-table>
        <div class="px-6 py-6">
            <x-jet-input type="text" wire:model='search' class="w-full" placeholder="Escriba lo que quiere buscar"/>
        </div>
        @if($posts->count())
            <table class="table-auto w-full">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Id</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Title</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-left">Content</div>
                        </th>
                        <th class="p-2 whitespace-nowrap">
                            <div class="font-semibold text-center">Edit</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach($posts as $post)
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">{{ $post->id }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">{{ $post->title }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">{{ $post->content }}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-left">Edit</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No hay registros con esa busqueda
            </div>
        @endif
    </x-table>
</div>
