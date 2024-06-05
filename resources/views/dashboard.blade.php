<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1>Laravel Reverbからのメッセージの受信</h1>
        <div>
            <label for="message">メッセージ:</label>
            <input type="text" id="message" name="message">
            <button id="send">送信</button>
        </div>
        <ul id="messages"></ul>
    </div>
</x-app-layout>
