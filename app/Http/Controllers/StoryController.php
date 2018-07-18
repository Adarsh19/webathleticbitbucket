<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Image;

class StoryController extends Controller
{

    // public function __construct() {
    //     $this->middleware('auth');
    // }

    
	 /**
     * Story home
     *
     * @return view
    */
	public function index()
    {
        return view('admin.story.index');
    }

    /**
     * Story listing page
     *
     * @return view
    */
	public function get()
    {
        $stories = Story::all();

        return datatables()->of($stories)
            ->editColumn('created_at', '{{ date("d F Y", strtotime($created_at)) }}')
            ->editColumn('updated_at', '{{ date("d F Y", strtotime($updated_at)) }}')
            ->addColumn('username', function ($stories) {
                return '<a class="user-view-button" role="button" tabindex="0" data-id="' . $stories->user->id . '">' . $stories->user->name . '</a>';
            })
            ->addColumn('publication_status', function ($stories) {
                if ($stories->publication_status == 1) {
                    return '<a href="' . route('admin.unpublishedStoriesRoute', $stories->id) . '" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to Unpublished"><i class="icon fa fa-arrow-down"></i>Published</a>';
                }
                return '<a href="' . route('admin.publishedStoriesRoute', $stories->id) . '" class="btn btn-warning btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Click to Published"><i class="icon fa fa-arrow-up"></i> Unpublished</a>';
            })
            ->addColumn('action', function ($stories) {
                return '<button class="btn btn-info btn-xs view-button" data-id="' . $stories->id . '" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i></button> <button class="btn btn-primary btn-xs edit-button" data-id="' . $stories->id . '" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btn-xs delete-button" data-id="' . $stories->id . '"data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash"></i></button>';
            })
            ->addColumn('story_featured_image', function ($posts) {
                if (!empty($posts->story_featured_image)) {
                    return '<img src="' . get_story_featured_image_url($posts->story_featured_image) . '" width="60" class="img img-thumbnail img-responsive">';
                }
                return '<img src="' . get_story_featured_image_url('no_image.jpg') . '" width="60" class="img img-thumbnail img-responsive">';
            })
            ->rawColumns(['username', 'publication_status', 'action', 'story_featured_image'])
            ->setRowId('id')
            ->make(true);
    }

    /**
     * Save story
     *
     * @return JSON
    */
	public function store(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'possition' => 'required|min:5|max:150',
            'content' => 'required|string',
            'publication_status' => 'required',
            'story_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
        ], [
            'name.required' => 'Story name is required.',
            'story_featured_image.dimensions' => 'Max dimensions 350x600',
        ]);

        if ($validator->passes()) {
            $story = Story::create([
                'user_id' => Auth::user()->id,
                'name' => $request->input('name'),
                'possition' => $request->input('possition'),
                'content' => $request->input('content'),
                'publication_status' => $request->input('publication_status'),
            ]);

            if ($request->hasFile('story_featured_image')) {
                $image = $request->file('story_featured_image');
                $file_name = $this->story_featured_image($story->id, $image);
                Story::find($story->id)->update(['story_featured_image' => $file_name]);
            }

            if (!empty($story->id)) {
                $request->session()->flash('message', 'Story add successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }

            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    
    /**
     * Story featured image
     *
     * @param integer id
     * @param string image
     * @return view
    */
	public function story_featured_image($id, $image)
    {
        $filename = $id . '.jpg';
        $location = get_story_featured_image_path($filename);
        // create new image with transparent background color
        $background = Image::canvas(688, 387);
        // read image file and resize it to 200x200
        $img = Image::make($image);
        // Image Height
        $height = $img->height();
        // Image Width
        $width = $img->width();
        $x = null;
        $y = null;
        if ($width < $height) {
            $y = 387;
        } else {
            $x = 688;
        }
        //Resize Image
        $img->resize($x, $y, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        // insert resized image centered into background
        $background->insert($img, 'center');
        // save
        $background->save($location);
        return $filename;
    }

    public function show($id)
    {
        $story = Story::with(['user:id,name'])->where('id', $id)
            ->first();
        return json_encode($story);
    }

    public function update(Request $request, $id)
    {
        $story = Story::find($id);

        if ($story->possition == $request->possition) {
            $possition = "required|min:5|max:150";
        } else {
            $possition = "required|min:5|max:150";
        }

        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'possition' => $possition,
            'content' => 'required|string',
            'publication_status' => 'required',
            'story_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
        ], [
            'name.required' => 'Story name is required.',
        ]);

        if ($validator->passes()) {
            $story->name = $request->get('name');
            $story->possition = $request->get('possition');
            $story->content = $request->get('content');
            $story->publication_status = $request->get('publication_status');


            if ($request->hasFile('story_featured_image')) {
                $image = $request->file('story_featured_image');
                $file_name = $this->story_featured_image($story->id, $image);
                $story->story_featured_image = $file_name;
            }

            $affected_row = $story->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Story update successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return Response::json(['success' => '1']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function published($id)
    {
        $affected_row = Story::where('id', $id)
            ->update(['publication_status' => 1]);

        if (!empty($affected_row)) {
            return redirect()->back()->with('message', 'Published successfully.');
        }
        return redirect()->back()->with('exception', 'Operation failed !');
    }

    public function unpublished($id)
    {
        $affected_row = Story::where('id', $id)
            ->update(['publication_status' => 0]);

        if (!empty($affected_row)) {
            return redirect()->back()->with('message', 'Unpublished successfully.');
        }
        return redirect()->back()->with('exception', 'Operation failed !');
    }

    public function destroy($id)
    {
        $story = Story::find($id);
        if (count($story)) {
            if ($story->story_featured_image) {
                @unlink(get_story_featured_image_path($story->story_featured_image));
            }
            $story->delete();
            return redirect()->back()->with('message', 'Story delete successfully.');
        } else {
            return redirect()->back()->with('exception', 'Story not found !');
        }
    }

    public function bulkDestroy($ids)
    {

        $users = Story::whereIn('id', $ids)
            ->get();
        $deleteUsers =  Story::whereIn('id', $ids)
            ->delete();
        foreach ($users as $key => $value) {
            if (isset($value->featured_image)) {
                @unlink(public_path('profile_images/' . $value->avatar));
            }
        }
        if ($deleteUsers) {
            $result = ['affected_row'=>$deleteUsers,'status'=>'success'];
        } else {
            $result = ['affected_row'=>$deleteUsers,'status'=>'failed'];
        }
        return $result;
    }
    public function bulkDestroyRequest(Request $request)
    {
        $ids = json_decode($request->get('ids'), true);
        $delete = $this->bulkDestroy($ids);
        if ($delete) {
            return redirect()->back()->with('message', 'Story deleted successfully.');
        }
        return redirect()->back()->with('exception', 'Story not found !');
    }
}
