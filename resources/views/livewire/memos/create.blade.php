<?php

use function Livewire\Volt\{state, rules};
use App\Models\Memo;

state([
    'title' => '',
    'body' => '',
]);

rules([
    'title' => 'required|max:50',
    'body' => 'required|max:2000',
]);

$save = function () {
    $validated = $this->validate();

    $memo = new Memo();
    $memo->user_id = auth()->id();
    $memo->title = $validated['title'];
    $memo->body = $validated['body'];
    $memo->save();

    $this->redirect(route('memos.show', $memo), navigate: true);
};

?>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h2 class="text-lg font-medium mb-4">新規メモ作成</h2>

        <form wire:submit="save" class="space-y-6">
            <div>
                <x-input-label for="title" value="タイトル" />
                <x-text-input wire:model="title" id="title" name="title" type="text" class="mt-1 block w-full"
                    required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="body" value="本文" />
                <x-textarea wire:model="body" id="body" name="body" class="mt-1 block w-full" rows="6"
                    required />
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>保存</x-primary-button>
                <x-secondary-button wire:navigate href="{{ route('memos.index') }}">
                    キャンセル
                </x-secondary-button>
            </div>
        </form>
    </div>
</div>
