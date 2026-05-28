<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スタッフ追加
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm rounded-lg p-6 max-w-3xl">
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <div class="font-bold mb-2">入力内容を確認してください。</div>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('staff.store') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">所属会社</label>
                <select name="partner_id" class="w-full border-gray-300 rounded-lg">
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">主店舗</label>
                <select name="store_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">未配属</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">氏名 <span class="text-red-600">※必須</span></label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">カナ</label>
                <input type="text" name="kana" class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">電話番号 <span class="text-red-600">※必須</span></label>
                <input type="text" name="phone" class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">メールアドレス <span class="text-red-600">※必須</span></label>
                <input type="email" name="email" class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">雇用形態</label>
                <select name="employment_type" class="w-full border-gray-300 rounded-lg">
                    <option value="employee">正社員</option>
                    <option value="contract" selected>契約社員</option>
                    <option value="outsource">業務委託</option>
                </select>
            </div>

            <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg">
                保存
            </button>
        </form>
    </div>
</x-app-layout>
