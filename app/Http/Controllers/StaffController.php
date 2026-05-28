<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Staff;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with(['partner', 'store'])
            ->orderBy('id')
            ->get();

        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $partners = Partner::where('is_active', true)->orderBy('id')->get();
        $stores = Store::where('is_active', true)->orderBy('id')->get();

        return view('staff.create', compact('partners', 'stores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_id' => ['required', 'exists:partners,id'],
            'store_id' => ['nullable', 'exists:stores,id'],
            'name' => ['required', 'max:255'],
            'kana' => ['nullable', 'max:255'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:staff,email'],
            'employment_type' => ['required', 'in:employee,contract,outsource'],
        ], [
            'partner_id.required' => '所属会社を選択してください。',
            'partner_id.exists' => '選択した所属会社が存在しません。',
            'store_id.exists' => '選択した店舗が存在しません。',
            'name.required' => '氏名を入力してください。',
            'name.max' => '氏名が長すぎます。',
            'kana.max' => 'カナが長すぎます。',
            'phone.required' => '電話番号を入力してください。',
            'phone.max' => '電話番号が長すぎます。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.max' => 'メールアドレスが長すぎます。',
            'email.unique' => 'そのメールアドレスは既に使用されています。',
            'employment_type.required' => '雇用形態を選択してください。',
            'employment_type.in' => '雇用形態の値が不正です。',
        ]);

        Staff::create([
            'partner_id' => $validated['partner_id'],
            'store_id' => $validated['store_id'] ?? null,
            'name' => $validated['name'],
            'kana' => $validated['kana'] ?? null,
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'employment_type' => $validated['employment_type'],
            'is_active' => true,
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'スタッフを追加しました');
    }

    public function edit(Staff $staff)
    {
        $partners = Partner::where('is_active', true)->orderBy('id')->get();
        $stores = Store::where('is_active', true)->orderBy('id')->get();

        return view('staff.edit', compact('staff', 'partners', 'stores'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'partner_id' => ['required', 'exists:partners,id'],
            'store_id' => ['nullable', 'exists:stores,id'],
            'name' => ['required', 'max:255'],
            'kana' => ['nullable', 'max:255'],
            'phone' => ['required', 'max:50'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('staff', 'email')->ignore($staff->id),
            ],
            'employment_type' => ['required', 'in:employee,contract,outsource'],
        ], [
            'partner_id.required' => '所属会社を選択してください。',
            'partner_id.exists' => '選択した所属会社が存在しません。',
            'store_id.exists' => '選択した店舗が存在しません。',
            'name.required' => '氏名を入力してください。',
            'name.max' => '氏名が長すぎます。',
            'kana.max' => 'カナが長すぎます。',
            'phone.required' => '電話番号を入力してください。',
            'phone.max' => '電話番号が長すぎます。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.max' => 'メールアドレスが長すぎます。',
            'email.unique' => 'そのメールアドレスは既に使用されています。',
            'employment_type.required' => '雇用形態を選択してください。',
            'employment_type.in' => '雇用形態の値が不正です。',
        ]);

        $staff->update([
            'partner_id' => $validated['partner_id'],
            'store_id' => $validated['store_id'] ?? null,
            'name' => $validated['name'],
            'kana' => $validated['kana'] ?? null,
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'employment_type' => $validated['employment_type'],
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'スタッフ情報を更新しました');
    }

    public function deactivate(Staff $staff)
    {
        $staff->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('staff.index')
            ->with('success', 'スタッフを停止しました');
    }
}
