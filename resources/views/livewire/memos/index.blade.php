<?php

use function Livewire\Volt\{state, computed};
use App\Models\Memo;

$memos = computed(function () {
    return auth()->user()->memos()->latest()->get();
});

?>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">メモ一覧</h1>
        <x-primary-button onclick="window.location.href='{{ route('memos.create') }}'">
            新規作成
        </x-primary-button>
    </div>

    <div class="space-y-4">
        @foreach ($this->memos as $memo)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:bg-gray-50 transition cursor-pointer"
                onclick="window.location.href='{{ route('memos.show', $memo) }}'">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $memo->title }}
                        </h2>
                        <span class="text-sm text-gray-500">
                            {{ $memo->created_at->format('Y/m/d H:i') }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($this->memos->isEmpty())
            <div class="text-center py-10">
                <p class="text-gray-500">メモがありません</p>
                <x-primary-button onclick="window.location.href='{{ route('memos.create') }}'" class="mt-4">
                    最初のメモを作成
                </x-primary-button>
            </div>
        @endif
    </div>
</div>
