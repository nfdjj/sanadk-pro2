<?php

namespace App\Http\Controllers;
use App\Models\Hero;

use Illuminate\Http\Request;

class HeroController extends Controller
{
    
   public function index()
      {
        $hero=Hero::all();
        return response()->json($hero,200);
      }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title_ar' => 'nullable|string',
            'title_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string'
        ]);

        $hero = Hero::create($validatedData);
        return response()->json($hero, 201);
    }

    public function show(int $id)
    {
        $hero = Hero::find($id);
        return response()->json($hero, 200);
    }

    public function update(Request $request, int $id)
    {
        $hero = Hero::findOrFail($id);

        $validatedData = $request->validate([
            'title_ar' => 'nullable|string',
            'title_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string'
        ]);

        foreach ($validatedData as $key => $value) {
            if ($value === '' || $value === null) {
                unset($validatedData[$key]);
            }
        }

        if (!empty($validatedData)) {
            $hero->update($validatedData);
        }

        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    public function getHero()
    {
        $hero = Hero::first();
        return response()->json($hero ?? [], 200);
    }

    public function saveHero(Request $request)
    {
        $validatedData = $request->validate([
            'title_ar' => 'nullable|string',
            'title_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'whatsapp_number' => 'nullable|string'
        ]);

        $hero = Hero::first();
        if ($hero) {
            $hero->update($validatedData);
        } else {
            $hero = Hero::create($validatedData);
        }

        if ($request->wantsJson()) {
            return response()->json($hero, 200);
        }

        return redirect()->back()->with('success', 'تم حفظ بيانات القسم الرئيسي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $hero = Hero::find($id);
        if ($hero) {
            $hero->delete();
        }

        if (request()->wantsJson()) {
            return response()->json($hero, 200);
        }

        return redirect()->back()->with('success', 'تم حذف القسم الرئيسي بنجاح');
    }

    /**
     * Delete the first Hero record (used by admin delete action).
     */
    public function deleteHero(Request $request)
    {
        $hero = Hero::first();
        $message = 'تم تفريغ محتوى القسم الرئيسي بنجاح';

        if (! $hero) {
            Hero::create([
                'title_ar' => null,
                'title_en' => null,
                'content_ar' => null,
                'content_en' => null,
            ]);
        } else {
            $hero->update([
                'title_ar' => null,
                'title_en' => null,
                'content_ar' => null,
                'content_en' => null,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => $message], 200);
        }

        return redirect()->back()->with('success', $message);
    }

    public function clear($id)
{
    $hero = Hero::findOrFail($id);
    
    // تفريغ جميع الحقول (جعلها null)
    $hero->update([
        'main_text' => null,
        'sub_text' => null,
        'button_text' => null,
    ]);
    
    return redirect()->back()->with('success', 'تم تفريغ محتوى الصفحة الرئيسية بنجاح');
}


}
