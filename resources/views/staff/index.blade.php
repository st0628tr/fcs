<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                スタッフ一覧
            </h2>

            <a href="{{ route('staff.create') }}"
               class="bg-gray-900 text-white px-4 py-2 rounded-lg">
                スタッフ追加
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
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">氏名</th>
                    <th class="px-6 py-4 text-left">所属会社</th>
                    <th class="px-6 py-4 text-left">主店舗</th>
                    <th class="px-6 py-4 text-left">雇用形態</th>
                    <th class="px-6 py-4 text-left">状態</th>
                    <th class="px-6 py-4 text-left">操作</th>
                </tr>
            </thead>

            <tbody>
                @foreach($staff as $person)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $person->id }}</td>
                        <td class="px-6 py-4">{{ $person->name }}</td>
                        <td class="px-6 py-4">{{ $person->partner->name }}</td>
                        <td class="px-6 py-4">{{ $person->store?->name ?? '未配属' }}</td>

                        <td class="px-6 py-4">
                            @switch($person->employment_type)
                                @case('employee')
                                    正社員
                                    @break
                                @case('contract')
                                    契約社員
                                    @break
                                @case('outsource')
                                    業務委託
                                    @break
                                @default
                                    不明
                            @endswitch
                        </td>

                        <td class="px-6 py-4">
                            @if($person->is_active)
                                <span class="text-green-600 font-bold">稼働中</span>
                            @else
                                <span class="text-red-600 font-bold">停止</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('staff.edit', $person) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                編集
                            </a>

                            @if($person->is_active)
                                <form method="POST"
                                      action="{{ route('staff.deactivate', $person) }}"
                                      class="inline"
                                      onsubmit="return confirm('このスタッフを停止しますか？');">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm ml-2">
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
