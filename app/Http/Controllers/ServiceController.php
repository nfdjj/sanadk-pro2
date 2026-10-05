<?php

namespace App\Http\Controllers;
use App\Models\Service;


use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getService()
    {
        $service = Service::first();
        return response()->json($service ?? [], 200);
    }

    public function saveService(Request $request)
    {
        $validatedData = $request->validate([
            'main_text_ar' => 'nullable|string',
            'main_text_en' => 'nullable|string',
            'service_image' => 'nullable',
            'title_text_ar' => 'nullable|string',
            'title_text_en' => 'nullable|string',
            'description_text_ar' => 'nullable|string',
            'description_text_en' => 'nullable|string',
            'button_text1_ar' => 'nullable|string',
            'button_text1_en' => 'nullable|string',
            'button_text2_ar' => 'nullable|string',
            'button_text2_en' => 'nullable|string',
            'service_image2' => 'nullable',
            'service_image3' => 'nullable',
            'service_image4' => 'nullable',
            'title_text2_ar' => 'nullable|string',
            'title_text2_en' => 'nullable|string',
            'title_text3_ar' => 'nullable|string',
            'title_text3_en' => 'nullable|string',
            'title_text4_ar' => 'nullable|string',
            'title_text4_en' => 'nullable|string',
            'description_text2_ar' => 'nullable|string',
            'description_text2_en' => 'nullable|string',
            'description_text3_ar' => 'nullable|string',
            'description_text3_en' => 'nullable|string',
            'description_text4_ar' => 'nullable|string',
            'description_text4_en' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'phone_number' => 'nullable|string'
        ]);

        $service = Service::first();

        $imageFields = ['service_image', 'service_image2', 'service_image3', 'service_image4'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $validatedData[$field] = 'uploads/' . $filename;
            } elseif ($service && isset($service->$field)) {
                $validatedData[$field] = $service->$field;
            }
        }

        if ($service) {
            $service->update($validatedData);
        } else {
            $service = Service::create($validatedData);
        }

        if ($request->wantsJson()) {
            return response()->json($service, 200);
        }

        return redirect()->back()->with('success', 'تم حفظ بيانات قسم الخدمات بنجاح');
    }
    public function index()
      {
        $service=Service::all();
        return response()->json($service,200);
      }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'main_text_ar' => 'nullable|string',
            'main_text_en' => 'nullable|string',
            'service_image' => 'nullable|string',
            'title_text_ar' => 'nullable|string',
            'title_text_en' => 'nullable|string',
            'description_text_ar' => 'nullable|string',
            'description_text_en' => 'nullable|string',
            'button_text1_ar' => 'nullable|string',
            'button_text1_en' => 'nullable|string',
            'button_text2_ar' => 'nullable|string',
            'button_text2_en' => 'nullable|string',
            'service_image2' => 'nullable|string',
            'service_image3' => 'nullable|string',
            'service_image4' => 'nullable|string',
            'title_text2_ar' => 'nullable|string',
            'title_text2_en' => 'nullable|string',
            'title_text3_ar' => 'nullable|string',
            'title_text3_en' => 'nullable|string',
            'title_text4_ar' => 'nullable|string',
            'title_text4_en' => 'nullable|string',
            'description_text2_ar' => 'nullable|string',
            'description_text2_en' => 'nullable|string',
            'description_text3_ar' => 'nullable|string',
            'description_text3_en' => 'nullable|string',
            'description_text4_ar' => 'nullable|string',
            'description_text4_en' => 'nullable|string'
        ]);
        $service = Service::create($validatedData);
        return response()->json($service, 201);
    }

    public function show(int $id)
    {
        $service=Service::find($id);
        return response()->json($service,200);
    }

    public function update(Request $request, int $id)
    {
    $service = Service::findOrFail($id);
    
    $validatedData = $request->validate([
        'main_text_ar' => 'nullable|string',
        'main_text_en' => 'nullable|string',
        'service_image' => 'nullable|string',
        'title_text_ar' => 'nullable|string',
        'title_text_en' => 'nullable|string',
        'description_text_ar' => 'nullable|string',
        'description_text_en' => 'nullable|string',
        'button_text1_ar' => 'nullable|string',
        'button_text1_en' => 'nullable|string',
        'button_text2_ar' => 'nullable|string',
        'button_text2_en' => 'nullable|string',
        'service_image2' => 'nullable|string',
        'service_image3' => 'nullable|string',
        'service_image4' => 'nullable|string',
        'title_text2_ar' => 'nullable|string',
        'title_text2_en' => 'nullable|string',
        'title_text3_ar' => 'nullable|string',
        'title_text3_en' => 'nullable|string',
        'title_text4_ar' => 'nullable|string',
        'title_text4_en' => 'nullable|string',
        'description_text2_ar' => 'nullable|string',
        'description_text2_en' => 'nullable|string',
        'description_text3_ar' => 'nullable|string',
        'description_text3_en' => 'nullable|string',
        'description_text4_ar' => 'nullable|string',
        'description_text4_en' => 'nullable|string'
    ]);

    // إزالة الحقول الفارغة من البيانات المرسلة
    foreach ($validatedData as $key => $value) {
        if ($value === '' || $value === null) {
            unset($validatedData[$key]); // إزالة الحقل الفارغ
        }
    }

    // تحديث فقط الحقول التي لها قيم
    if (!empty($validatedData)) {
        $service->update($validatedData);
    }
        return redirect()->back()->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $service=Service::find($id);
        $service->delete();
        return response()->json($service,200);
    }

    /**
     * Delete the first Service record (used by admin delete action).
     */
    public function deleteService(Request $request)
    {
        $service = Service::first();
        $message = 'تم تفريغ محتوى قسم الخدمات بنجاح';

        if (! $service) {
            Service::create([
                'main_text_ar' => null,
                'main_text_en' => null,
                'service_image' => null,
                'title_text_ar' => null,
                'title_text_en' => null,
                'description_text_ar' => null,
                'description_text_en' => null,
                'button_text1_ar' => null,
                'button_text1_en' => null,
                'button_text2_ar' => null,
                'button_text2_en' => null,
                'service_image2' => null,
                'service_image3' => null,
                'service_image4' => null,
                'title_text2_ar' => null,
                'title_text2_en' => null,
                'title_text3_ar' => null,
                'title_text3_en' => null,
                'title_text4_ar' => null,
                'title_text4_en' => null,
                'description_text2_ar' => null,
                'description_text2_en' => null,
                'description_text3_ar' => null,
                'description_text3_en' => null,
                'description_text4_ar' => null,
                'description_text4_en' => null,
            ]);
        } else {
            $service->update([
                'main_text_ar' => null,
                'main_text_en' => null,
                'service_image' => null,
                'title_text_ar' => null,
                'title_text_en' => null,
                'description_text_ar' => null,
                'description_text_en' => null,
                'button_text1_ar' => null,
                'button_text1_en' => null,
                'button_text2_ar' => null,
                'button_text2_en' => null,
                'service_image2' => null,
                'service_image3' => null,
                'service_image4' => null,
                'title_text2_ar' => null,
                'title_text2_en' => null,
                'title_text3_ar' => null,
                'title_text3_en' => null,
                'title_text4_ar' => null,
                'title_text4_en' => null,
                'description_text2_ar' => null,
                'description_text2_en' => null,
                'description_text3_ar' => null,
                'description_text3_en' => null,
                'description_text4_ar' => null,
                'description_text4_en' => null,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => $message], 200);
        }

        return redirect()->back()->with('success', $message);
    }

    public function clear($id)
{
    $service = Service::findOrFail($id);
    
    // تفريغ جميع الحقول (جعلها null)
    $service->update([
        'main_text' => null,
        'service_image' => null,
        'title_text_ar' => null,
        'title_text_en' => null,
        'description_text_ar' => null,
        'description_text_en' => null,
        'button_text1_ar' => null,
        'button_text1_en' => null,
        'button_text2_ar' => null,
        'button_text2_en' => null,
        'service_image2' => null,
        'service_image3' => null,
        'service_image4' => null,
        'title_text2_ar' => null,
        'title_text2_en' => null,
        'title_text3_ar' => null,
        'title_text3_en' => null,
        'title_text4_ar' => null,
        'title_text4_en' => null,
        'description_text2_ar' => null,
        'description_text2_en' => null,
        'description_text3_ar' => null,
        'description_text3_en' => null,
        'description_text4_ar' => null,
        'description_text4_en' => null,
    ]);
    
    return redirect()->back()->with('success', 'تم تفريغ محتوى الصفحة الرئيسية بنجاح');
}

}


