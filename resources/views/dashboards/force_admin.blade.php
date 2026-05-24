<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Force Control System
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">フォース管理画面</h3>

                <p class="mb-6 text-gray-600">
                    force_admin としてログイン中です。
                </p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-sm text-gray-500">全国PI</div>
                        <div class="text-3xl font-bold">0</div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-sm text-gray-500">全国pt</div>
                        <div class="text-3xl font-bold">0</div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-sm text-gray-500">本日未提出</div>
                        <div class="text-3xl font-bold">0名</div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-sm text-gray-500">承認待ち</div>
                        <div class="text-3xl font-bold">0件</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
