<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗編集
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm rounded-lg p-6 max-w-3xl">

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">

                <div class="font-bold mb-2">
                    入力内容を確認してください。
                </div>

                <ul class="list-disc list-inside text-sm">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>
        @endif

        <form
            method="POST"
            action="{{ route('stores.update', $store) }}"
        >

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block text-sm font-bold mb-2">
                    地域
                </label>

                <select
                    name="area_id"
                    class="w-full border-gray-300 rounded-lg"
                >

                    @foreach($areas as $area)

                        <option
                            value="{{ $area->id }}"
                            @selected($store->area_id == $area->id)
                        >
                            {{ $area->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-6">

                <label class="block text-sm font-bold mb-2">
                    店舗名
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $store->name }}"
                    class="w-full border-gray-300 rounded-lg"
                >

            </div>

            <div class="mb-6">

                <label class="block text-sm font-bold mb-2">
                    店舗コード
                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ $store->code }}"
                    class="w-full border-gray-300 rounded-lg"
                >

            </div>

            <button
                type="submit"
                class="bg-gray-900 text-white px-6 py-3 rounded-lg"
            >
                更新
            </button>

        </form>

    </div>

</x-app-layout>
