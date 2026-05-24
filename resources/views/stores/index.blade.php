<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                店舗一覧
            </h2>

            <a
                href="{{ route('stores.create') }}"
                class="bg-gray-900 text-white px-4 py-2 rounded-lg"
            >
                店舗追加
            </a>

        </div>

    </x-slot>

    @if (session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-4 text-left">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left">
                        店舗名
                    </th>

                    <th class="px-6 py-4 text-left">
                        地域
                    </th>

                    <th class="px-6 py-4 text-left">
                        状態
                    </th>

                    <th class="px-6 py-4 text-left">
                        操作
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($stores as $store)

                    <tr class="border-t">

                        <td class="px-6 py-4">
                            {{ $store->id }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $store->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $store->area->name }}
                        </td>

                        <td class="px-6 py-4">

                            @if($store->is_active)

                                <span class="text-green-600 font-bold">
                                    稼働中
                                </span>

                            @else

                                <span class="text-red-600 font-bold">
                                    停止
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <a
                                href="{{ route('stores.edit', $store) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm"
                            >
                                編集
                            </a>

                            @if($store->is_active)

                                <form
                                    method="POST"
                                    action="{{ route('stores.deactivate', $store) }}"
                                    class="inline"
                                    onsubmit="return confirm('この店舗を停止しますか？');"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm ml-2"
                                    >
                                        停止
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</x-app-layout>
