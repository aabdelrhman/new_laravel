<?php

namespace App\Http\Controllers;

use App\Exports\exprotProduct;
use App\Exports\exprotSection;
use App\Http\Requests\insertSection;
use App\Imports\importSection;
use App\Models\Admin;
use App\Models\Section;
use App\Notifications\AddSectionNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

class SectionController extends Controller
{

    public function __construct(){
        $this->middleware('permission:show-section');
        $this->middleware('permission:create-section' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:edit-section' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete-section' , ['only' => ['destroy']]);
    }

    function index(){
        $sections = Section::selection()->paginate(10);
        return view('Admin.Section.index' , get_defined_vars());
    }

    function create(){
        return view('Admin.Section.create');
    }

    function store(insertSection $request){
        try {
            if($request->hasFile('photo')){
                $file_name = saveImage($request->file('photo') , "images/Section/");
                $section = Section::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'desc_en' => $request->desc_en,
                    'desc_ar' => $request->desc_ar,
                    'photo' => $file_name
                ]);
                $owner = Admin::whereRoleIs('owner')->get();
                Notification::send($owner , new AddSectionNotification($section));
                return redirect()->route('section.index')->with('success' , __('messages.success add'));
            }
        } catch (\Throwable $th) {
            return redirect()->route('section.index')->with('error' , __('messages.error add'));
        }

    }

    function edit(Section $section){
        if($section){
            return view('Admin.Section.edit' , get_defined_vars());
        }
        else{
            return redirect()->route('Dashboard')->with('error' , __('messages.error section add'));
        }
    }

    function update(insertSection $request , Section $section){
        try {
            if($section){
                if ($request->has('status')) {  // Check active ratio
                    $request->request->add(['status' => 1]); //add request section is active
                }else {
                    $request->request->add(['status' => 0]); //add request section is not active
                }
                if($request->hasFile('photo')){ // check found image in request
                    removeImage($section->photo , "images/Section/"); // Remove image
                    $file_name = saveImage($request->file('photo') , "images/Section/"); //add new image
                    $section->update([
                        'name_en' => $request->name_en,
                        'name_ar' => $request->name_ar,
                        'desc_en' => $request->desc_en,
                        'desc_ar' => $request->desc_ar,
                        'photo' => $file_name,
                        'status' => $request->status
                    ]);
                }else{
                    $section->update([
                        'name_en' => $request->name_en,
                        'name_ar' => $request->name_ar,
                        'desc_en' => $request->desc_en,
                        'desc_ar' => $request->desc_ar,
                        'status' => $request->status
                    ]);
                }
                return redirect()->route('section.index')->with('success' , __('messages.success update'));
            }
            else{
                return redirect()->route('Dashboard')->with('error' , __('messages.error add'));
            }
        } catch (\Throwable $th) {
            return $th ;
            return redirect()->route('section.index')->with('error' , __('messages.error add'));
        }
    }

    function destroy($id){
        try {
        $section = Section::with('products')->findOrFail($id);
            if($section){
                removeImage($section->photo , "images/Section/");
                $section->delete();
                return redirect()->route('section.index')->with('success' , __('messages.success delete'));
            }
            else{
                return redirect()->route('Dashboard')->with('error' , __('messages.error delete'));
            }
        } catch (\Throwable $th) {
            return $th ;
            return redirect()->route('section.index')->with('error' , __('messages.error delete'));
        }

    }

    public function importSectionExcel(Request $request)
    {
        $request->validate([
           'excel' => 'required|mimes:xls,xlsx',
        ]);
        Excel::import(new importSection,$request->file('excel'));
        return redirect()->route('section.index')->with('success', 'The file has been excel/csv imported to database in laravel 8');
    }

    public function exportSectionExcl($slug)
    {
        return Excel::download(new exprotSection, 'sections.'.$slug);
    }

    public function markRead($id){
        $notification = auth()->guard('admin')->user()->unreadNotifications->find($id);
        $notification->markAsRead();
        return redirect()->route('section.edit', $notification->data['section_id']);
    }
}
