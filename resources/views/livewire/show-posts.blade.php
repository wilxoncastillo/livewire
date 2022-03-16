<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" wire:init="loadPosts">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <x-table>
        <div class="px-6 py-6 flex items-center">
            <x-jet-input type="text" wire:model='search' class="flex-1 mr-4" placeholder="Escriba lo que quiere buscar"/>
            
            @livewire('create-post')
        </div>
        @if(count($posts))
            <table class="table-auto">
                <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                    <tr>
                        <th class="cursor-pointer p-2 w-20" wire:click="order('id')">
                            <div class="font-semibold text-left">
                                @if($sort == 'id')
                                    @if($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif

                                Id
                            </div>
                        </th>
                        <th class="cursor-pointer p-2" wire:click="order('title')">
                            <div class="font-semibold text-left">
                                @if($sort == 'title')
                                    @if($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif

                                Title
                            </div>
                        </th>
                        <th class="cursor-pointer p-2 whitespace-wrap" wire:click="order('content')">
                            <div class="font-semibold text-left">
                                 @if($sort == 'content')
                                    @if($direction == 'asc')
                                        <i class="fa fa-sort-alpha-up-alt"></i>
                                    @else
                                        <i class="fa fa-sort-alpha-down-alt"></i>
                                    @endif
                                @else
                                    <i class="fa fa-sort"></i>
                                @endif

                                Content
                            </div>
                        </th>
                        <th class="p-2">
                            <div class="font-semibold text-center">Edit</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach($posts as $item)
                    <tr>
                        <td class="p-2">
                            <div class="text-left">{{ $item->id }}</div>
                        </td>
                        <td class="p-2">
                            <div class="text-left">{{ $item->title }}</div>
                        </td>
                        <td class="p-2">
                            <div class="text-left">{!! $item->content !!}</div>
                        </td>
                        <td class="flex">
                            {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                            <a class="" wire:click="edit({{ $item }})">
                                <i class="fa fa-edit btn btn-green"></i>
                            </a>
                            
                            <a class="ml-2" wire:click="$emit('deletePost', {{ $item->id }})">
                                <i class="fa fa-trash btn btn-red"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($posts->hasPages())
                <div class="px-6 py-3">
                    {{ $posts->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No hay registros con esa busqueda
            </div>
        @endif
        

    </x-table>

    {{-- Modal editar post--}}
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name='title'>
            Editar post
        </x-slot>

        <x-slot name='content'>
            <div wire:loading wire wire:target="image" class="w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargand ...!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado.</span>
            </div>

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mb-4">
            @else
                <img src="{{ Storage::url($post->image) }}" class="mb-4">
            @endif

            <div class="mb-4">
                <x-jet-label value="Titulo del post" />
                <x-jet-input type="text" class="w-full" wire:model="post.title" />
                <x-jet-input-error for="post.title" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows="6" class="form-control w-full" wire:model="post.content"></textarea>
                <x-jet-input-error for="post.content" />
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}"/>
                <x-jet-input-error for="image" />
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button class="mr-4" wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled"  wire:target="update,image" class="disabled:opacity-20">
                Actualizar post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            
            Livewire.on('deletePost', postId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('show-posts', 'delete', postId);

                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                })
            });

        </script>
    @endpush
            
 </div>
