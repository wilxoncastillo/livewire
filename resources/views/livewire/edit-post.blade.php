<div>
    <div>
        <a class="" wire:click="$set('open', true)">
            <i class="fa fa-edit btn btn-green"></i>
        </a>
    </div>

    <x-jet-dialog-modal wire:model="open">

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
            <x-jet-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled"  wire:target="save,image" class="disabled:opacity-20">
                Actualizar post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
