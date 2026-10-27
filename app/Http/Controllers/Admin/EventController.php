<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademyCategory;
use App\Models\AcademyEvent;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = AcademyEvent::orderBy('created_at', 'desc')->lazy();

        return view('admin.event.index',[
            'data' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AcademyCategory::all();

        return view('admin.event.create',[
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        $name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->title);
        $name = preg_replace('/\s+/', ' ', $name);
        $slug = strtolower(str_replace(' ', '-', $name));
        $check = AcademyEvent::where('slug', $slug)->first();
        if($check){
            $slug .= "-".time();
        }

        // menyimpan data file yang diupload
        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $folder = 'img';
        $image->move($folder,$image_name);

        AcademyEvent::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'status' => $request->status,
            'image' => $image_name,
            'about' => $request->about,
            'career' => $request->career,
            'earn' => $request->earn,
            'benefit' => $request->benefit,
            'curriculum' => $request->curriculum,
        ]);

        $request->session()->flash('alert-success', 'Event berhasil dibuat');
        return redirect()->route('admin.event.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = AcademyEvent::findOrFail($id);
        $categories = AcademyCategory::all();

        return view('admin.event.edit',[
            'categories' => $categories,
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'location' => 'required',
            'status' => 'required',
        ]);

        $event = AcademyEvent::findOrFail($id);
        if(!empty($request->image)){
            // menyimpan data file yang diupload
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $folder = 'img';
            $image->move($folder,$image_name);

            $image_old = $event->image;
            $image_path = public_path('img/'.$image_old);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }

        $event->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'status' => $request->status,
            'image' => (!empty($request->image)) ? $image_name : $event->image,
            'about' => $request->about,
            'career' => $request->career,
            'earn' => $request->earn,
            'benefit' => $request->benefit,
            'curriculum' => $request->curriculum,
        ]);

        $request->session()->flash('alert-success', 'Event berhasil dibuat');
        return redirect()->route('admin.event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        AcademyEvent::findOrFail($id)->delete();
        $request->session()->flash('alert-success', 'Event berhasil dihapus');
        return redirect()->back();
    }
}
