<?php

use function Livewire\Volt\{state, mount, rules};
use App\Models\Memo;

state([
    'memo' => null,
    'title' => '',
    'body' => '',
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

$save = function () {
    $validated = $this->validate();

    $this->memo->update([
        'title' => $validated['title'],
        'body' => $validated['body'],
    ]);

    $this->redirect(route('memos.show', $this->memo), navigate: true);
};

?>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h2 class="text-lg font-medium mb-4">メモの編集</h2>

        <form wire:submit="save" class="space-y-6">
            <div>
                <x-input-label for="title" value="タイトル" />
                <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full"
                    required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="body" value="本文" />
                <x-textarea wire:model="body" id="body" name="body" class="mt-1 block w-full" rows="10"
                    required />
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>更新</x-primary-button>
                <x-secondary-button wire:navigate href="{{ route('memos.show', $memo) }}">キャンセル</x-secondary-button>
            </div>
        </form>
    </div>
</div>
