<?php

namespace App\Http\Controllers;
use App\Models\Opinion;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function index()
      {
        $opinions = Opinion::orderByDesc('created_at')->get();
        return response()->json($opinions, 200);
      }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'opinion' => 'required|string|max:1000',
          'rating' => 'required|integer|min:1|max:5'
         ]);

         // ensure rating key exists (may be null)
         $data = [
            'name' => $validatedData['name'],
            'opinion' => $validatedData['opinion'],
            'rating' => $validatedData['rating'] ?? null,
            'approval_status' => 'pending',
        ];

         $opinions = Opinion::create($data);
         return response()->json($opinions, 201);
    }

    public function show(int $id)
    {
        $opinions=Opinion::find($id);
        return response()->json($opinions,200);
    }

    public function update(Request $request, int $id)
    {
    $opinions = Opinion::findOrFail($id);
    
    $validatedData = $request->validate([
        'name'=>'nullable',
        'opinion'=>'nullable',
        'button_text'=>'nullable'
    ]);

    // إزالة الحقول الفارغة من البيانات المرسلة
    foreach ($validatedData as $key => $value) {
        if ($value === '' || $value === null) {
            unset($validatedData[$key]); // إزالة الحقل الفارغ
        }
    }

    // تحديث فقط الحقول التي لها قيم
    if (!empty($validatedData)) {
        $opinions->update($validatedData);
    }
        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    public function approve(Request $request, int $id)
    {
        $opinion = Opinion::findOrFail($id);
    
        $opinion->update([
            'approval_status' => 'approved',
        ]);
    
        return redirect()->back()->with(
            'success',
            'تمت الموافقة على تعليق العميل بنجاح'
        );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $opinions = Opinion::find($id);
        if ($opinions) {
            $opinions->delete();
        }

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Opinion deleted', 'id' => $id], 200);
        }

        return redirect()->back()->with('success', 'تم حذف الرد بنجاح');

    }

    public function clear($id)
{
    $opinions = Opinion::findOrFail($id);
    
    // تفريغ جميع الحقول (جعلها null)
    $opinions->update([
        'name' => null,
        'opinion' => null,
        'button_text' => null,
    ]);
    
    return redirect()->back()->with('success', 'تم تفريغ محتوى الصفحة الرئيسية بنجاح');
}
}
