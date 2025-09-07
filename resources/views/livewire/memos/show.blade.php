<?php

use function Livewire\Volt\{state, mount};
use App\Models\Memo;

state(['memo' => null]);

mount(function (Memo $memo) {
    $this->memo = $memo;
});

?>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $memo->title }}</h1>

        <div class="prose max-w-none">
            {!! nl2br(e($memo->body)) !!}
        </div>

        <div class="mt-4 text-sm text-gray-500">
            作成日時: {{ $memo->created_at->format('Y年m月d日 H:i') }}
        </div>

        <div class="mt-6 flex justify-end space-x-4">
            <x-primary-button wire:navigate href="{{ route('memos.edit', $memo) }}">
                編集
            </x-primary-button>

            <x-secondary-button wire:navigate href="{{ route('memos.index') }}">
                戻る
            </x-secondary-button>
        </div>
    </div>
</div>
