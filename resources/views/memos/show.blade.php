<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            メモ詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:memos.show :memo="$memo" />
    </div>
</x-app-layout>
