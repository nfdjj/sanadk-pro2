<?php

namespace App\Http\Controllers;
use App\Models\WhoUs;

use Illuminate\Http\Request;

class WhoUsController extends Controller
{
    public function getWhoUs()
    {
        $whous = WhoUs::first();
        return response()->json($whous ?? [], 200);
    }

    public function saveWhoUs(Request $request)
    {
        $validatedData = $request->validate([
            'main_text_ar' => 'nullable|string',
            'main_text_en' => 'nullable|string',
            'sub_text1_ar' => 'nullable|string',
            'sub_text1_en' => 'nullable|string',
            'sub_text2_ar' => 'nullable|string',
            'sub_text2_en' => 'nullable|string'
        ]);

        $whous = WhoUs::first();
        if ($whous) {
            $whous->update($validatedData);
        } else {
            $whous = WhoUs::create($validatedData);
        }

        if ($request->wantsJson()) {
            return response()->json($whous, 200);
        }

        return redirect()->back()->with('success', 'تم حفظ بيانات قسم من نحن بنجاح');
    }
    public function index()
      {
        $whous=WhoUs::all();
        return response()->json($whous,200);
      }

    public function store(Request $request)
    {
        
       $validatedData=$request->validate([
        'main_text'=>'nullable',
        'sub_text1'=>'nullable',
        'sub_text2'=>'nullable'
        
   ]);
   $whous=WhoUs::create($validatedData);
    return response()->json($whous,201);
    }

    public function show(int $id)
    {
        $whous=WhoUs::find($id);
        return response()->json($whous,200);
    }

    public function update(Request $request, int $id)
    {
    $whous = WhoUs::findOrFail($id);
    
    $validatedData = $request->validate([
        'main_text'=>'nullable',
        'sub_text1'=>'nullable',
        'sub_text2'=>'nullable'
    ]);

    // إزالة الحقول الفارغة من البيانات المرسلة
    foreach ($validatedData as $key => $value) {
        if ($value === '' || $value === null) {
            unset($validatedData[$key]); // إزالة الحقل الفارغ
        }
    }

    // تحديث فقط الحقول التي لها قيم
    if (!empty($validatedData)) {
        $whous->update($validatedData);
    }
        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $whous=WhoUs::find($id);
        $whous->delete();
        return response()->json($whous,200);

    }

    public function clear($id)
{
    $whous = WhoUs::findOrFail($id);
    
    // تفريغ جميع الحقول (جعلها null)
    $whous->update([
        'main_text' => null,
        'sub_text1' => null,
        'sub_text2' => null,
    ]);
    
    return redirect()->back()->with('success', 'تم تفريغ محتوى الصفحة الرئيسية بنجاح');
}

    /**
     * Delete the first WhoUs record (used by admin delete action).
     */
    public function deleteWhoUs(Request $request)
    {
        $whous = WhoUs::first();
        $message = 'تم تفريغ محتوى قسم من نحن بنجاح';

        if (! $whous) {
            WhoUs::create([
                'main_text_ar' => null,
                'main_text_en' => null,
                'sub_text1_ar' => null,
                'sub_text1_en' => null,
                'sub_text2_ar' => null,
                'sub_text2_en' => null,
            ]);
        } else {
            $whous->update([
                'main_text_ar' => null,
                'main_text_en' => null,
                'sub_text1_ar' => null,
                'sub_text1_en' => null,
                'sub_text2_ar' => null,
                'sub_text2_en' => null,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => $message], 200);
        }

        return redirect()->back()->with('success', $message);
    }
}
