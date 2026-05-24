<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('area')
            ->orderBy('id')
            ->get();

        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        $areas = Area::orderBy('id')->get();

        return view('stores.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_id' => ['required', 'exists:areas,id'],
            'name' => ['required', 'max:255'],
            'code' => [
                'required',
                'max:255',
                'unique:stores,code',
                'regex:/^[a-z0-9_]+$/',
            ],
        ], [
            'area_id.required' => '地域を選択してください。',
            'area_id.exists' => '選択した地域が存在しません。',
            'name.required' => '店舗名を入力してください。',
            'name.max' => '店舗名が長すぎます。',
            'code.required' => '店舗コードを入力してください。',
            'code.unique' => 'その店舗コードは既に使用されています。',
            'code.regex' => '店舗コードは半角英小文字・数字・アンダーバーのみ使用できます。',
        ]);

        Store::create([
            'area_id' => $validated['area_id'],
            'name' => $validated['name'],
            'code' => $validated['code'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('stores.index')
            ->with('success', '店舗を追加しました');
    }

    public function edit(Store $store)
    {
        $areas = Area::orderBy('id')->get();

        return view('stores.edit', compact('store', 'areas'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'area_id' => ['required', 'exists:areas,id'],
            'name' => ['required', 'max:255'],
            'code' => [
                'required',
                'max:255',
                'regex:/^[a-z0-9_]+$/',
                Rule::unique('stores', 'code')->ignore($store->id),
            ],
        ], [
            'area_id.required' => '地域を選択してください。',
            'area_id.exists' => '選択した地域が存在しません。',
            'name.required' => '店舗名を入力してください。',
            'name.max' => '店舗名が長すぎます。',
            'code.required' => '店舗コードを入力してください。',
            'code.regex' => '店舗コードは半角英小文字・数字・アンダーバーのみ使用できます。',
            'code.unique' => 'その店舗コードは既に使用されています。',
        ]);

        $store->update([
            'area_id' => $validated['area_id'],
            'name' => $validated['name'],
            'code' => $validated['code'],
        ]);

        return redirect()
            ->route('stores.index')
            ->with('success', '店舗情報を更新しました');
    }

    public function deactivate(Store $store)
    {
        $store->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('stores.index')
            ->with('success', '店舗を停止しました');
    }
}
