<?php

namespace App\Http\Controllers;
use App\Models\WhyUs;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    public function getWhyUs()
    {
        $whyus = WhyUs::first();
        return response()->json($whyus ?? [], 200);
    }

    public function saveWhyUs(Request $request)
    {
        $validatedData = $request->validate([
            'main_text_ar' => 'nullable|string',
            'main_text_en' => 'nullable|string',
            'sub_text1_ar' => 'nullable|string',
            'sub_text1_en' => 'nullable|string',
            'sub_text2_ar' => 'nullable|string',
            'sub_text2_en' => 'nullable|string'
        ]);

        $whyus = WhyUs::first();
        if ($whyus) {
            $whyus->update($validatedData);
        } else {
            $whyus = WhyUs::create($validatedData);
        }

        if ($request->wantsJson()) {
            return response()->json($whyus, 200);
        }

        return redirect()->back()->with('success', 'تم حفظ بيانات قسم لماذا نحن بنجاح');
    }
    public function index()
      {
        $whyus=WhyUs::all();
        return response()->json($whyus,200);
      }

    public function store(Request $request)
    {
        
       $validatedData=$request->validate([
        'main_text'=>'nullable',
        'sub_text1'=>'nullable',
        'sub_text2'=>'nullable'
   ]);
   $whyus=WhyUs::create($validatedData);
    return response()->json($whyus,201);
    }

    public function show(int $id)
    {
        $whyus=WhyUs::find($id);
        return response()->json($whyus,200);
    }

    public function update(Request $request, int $id)
    {
    $whyus = WhyUs::findOrFail($id);
    
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
        $whyus->update($validatedData);
    }
        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $whyus=WhyUs::find($id);
        $whyus->delete();
        return response()->json($whyus,200);
    }

    /**
     * Delete the first WhyUs record (used by admin delete action).
     */
    public function deleteWhyUs(Request $request)
    {
        $whyus = WhyUs::first();
        $message = 'تم تفريغ محتوى قسم لماذا نحن بنجاح';

        if (! $whyus) {
            WhyUs::create([
                'main_text_ar' => null,
                'main_text_en' => null,
                'sub_text1_ar' => null,
                'sub_text1_en' => null,
                'sub_text2_ar' => null,
                'sub_text2_en' => null,
            ]);
        } else {
            $whyus->update([
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

    public function clear($id)
{
    $whyus = WhyUs::findOrFail($id);
    
    // تفريغ جميع الحقول (جعلها null)
    $whyus->update([
        'main_text' => null,
        'sub_text1' => null,
        'sub_text2' => null,
    ]);
    
    return redirect()->back()->with('success', 'تم تفريغ محتوى الصفحة الرئيسية بنجاح');
}

}
