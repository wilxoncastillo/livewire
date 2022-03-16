<div>
    <p>Count: {{ $count }}</p>

    <button wire:click="incrementar" class="btn btn-green">
        Aumentar
    </button>

    {{-- <div x-data="{ count: $wire.count }"> --}}
    {{-- <div x-data="{ count: @entangle('count') }"> --}}
    <div x-data="{ count: @entangle('count').defer }">
        <p>count dentro de Alpine <span x-text="count"></span></p>

        <button @click="count++" class="btn btn-green">
            Aumentar
        </button>
    </div>
</div>
