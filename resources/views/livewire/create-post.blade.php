<div>
    <x-jet-danger-button class="ml-4" wire:click="$set('open', true)">
        Crear nuevo post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name='title'>
            Crear nuevo post
        </x-slot>
        
        <x-slot name='content'>

            <div class="mb-4">
                <x-jet-label value="Titulo del post" />
                <x-jet-input type="text" class="w-full" wire:model.defer="title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del post" />
                <textarea rows="6" class="form-control w-full" wire:model.defer="content"></textarea>
            </div>
        </x-slot>
        
        <x-slot name='footer'>
            <x-jet-secondary-button class="mr-4" wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            
            <x-jet-danger-button wire:click="save">
                Crear post
            </x-jet-danger-button>

        </x-slot>

    </x-jet-dialog-modal>
</div>
