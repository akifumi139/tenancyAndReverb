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
    <script type="module">
        const tenant = @js(tenant()->id);
console.log(`test-channel.${tenant}`);
        Echo.private(`test-channel.${tenant}`).listen("TestEvent", function (e) {
            const newMessage = document.createElement("li");
            newMessage.textContent = e.message;
            const ul = document.getElementById("messages");
            ul.appendChild(newMessage);
        });

        document.getElementById("send").addEventListener("click", function () {
            const message = document.getElementById("message").value;
            if (!message) return;
            axios.post("/", { message: message }).then(() => {
                document.getElementById("message").value = "";
            });
        });
    </script>
</x-app-layout>
