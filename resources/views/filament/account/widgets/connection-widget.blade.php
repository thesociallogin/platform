<x-filament-widgets::widget>
  <x-filament::section>
    <x-slot name="heading">
      {{ $connection->name }}
    </x-slot>

    <div class="flex flex-col space-y-4">
      <div class="text-sm text-center text-gray-700 dark:text-white">
        {!! $connection->description !!}
      </div>
      <x-filament::button wire:click="openConnection('{{ $connection->getKey() }}')" class="w-full">Login</x-filament::button>
    </div>
  </x-filament::section>
</x-filament-widgets::widget>
