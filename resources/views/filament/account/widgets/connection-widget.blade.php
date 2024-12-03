<x-filament-widgets::widget>
  <x-filament::section>
    <x-slot name="heading">
      {{ $connection->name }}
    </x-slot>

    <x-slot name="description">
      {{ $connection->description }}
    </x-slot>

    <x-filament::button wire:click="openConnection('{{ $connection->getKey() }}')">Login</x-filament::button>
  </x-filament::section>
</x-filament-widgets::widget>
