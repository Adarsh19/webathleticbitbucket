<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Story;
use App\Company;
use App\CompanyUI;
use App\Gallery;
use App\SiteImage;
use Image;
use DB;
use Auth;

class StoriesController extends Controller
{
    //
    public function index($slug="")
    {
        # code...

        $is_company = false;
        $company_data = array();
        $hasUI = false;
        if(isset($slug) && $slug != ""){
            $company = Company::where("slug", $slug)->first();
            if(!empty($company)){
                $hasUI = CompanyUI::where("company_id", $company->id)->get()->count();
                $is_company = true;
                $company_data['logo'] = $company->logo;
                $company_data['slug'] = $company->slug;
                $company_data['name'] = $company->name;
                $company_data['id'] = $company->id;
                $company_data['ui'] = CompanyUI::where("company_id", $company->id)->first();
            }
        }
        $clients = Story::where(['publication_status' => 1])->orderBy('created_at', 'desc')->limit(6)->get();
        $gallery_images = Gallery::where(['publication_status' => 1])->orderBy('created_at', 'asc')->paginate(5);

        return view('pages.client', compact('clients', 'stories', 'gallery_images', 'company_data', 'is_company', 'hasUI'));
    }


    public function show($id)
    {
        $story = Story::where('id', $id)->first();
        return \Response::json($story);
    }

/*
*
*******
*******
*
*/
    public function update(Request $request, $id)
    {

        $story = Story::where('id', $id)->first();

        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'possition' => 'required|min:5|max:150',
            'content' => 'required|string',
            'publication_status' => 'required',
            'story_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
            //'story_featured_image' => 'required',
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
                $filename = $this->story_featured_image($story->id, $image);
                $story->story_featured_image = $filename;
            }


            if (!empty($request->thumb) && isset($request->thumb)) {
                $cropped_img_b64 = $request->thumb;
                $urls = getcwd();
                $url = str_replace("\\", "/", $urls);
                $destinationPath = 'story_featured_image/';
                $imgname = 'thumb_'.$story->story_featured_image;
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
                file_put_contents($url."/".$destinationPath.$imgname, $data);
                $filename =  $destinationPath . '' . $imgname;
                $story->thumb = $imgname;
            }

            $affected_row = $story->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Story update successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return \Response::json(['success' => '1']);
        }

        return \Response::json(['errors' => $validator->errors()]);
    }



    public function story_featured_image($id, $image)
    {
        $filename = $id . '.jpg';
        $location = 'story_featured_image/'.$filename;
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



    public function updateImages(Request $request)
    {
        // $echoTxt = '';
        

        $validator = $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'title' => 'required|max:150',
            'image_hight' => 'required|numeric',
            'image_width' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            //'story_featured_image' => 'required',
        ]);

        if ($validator->passes()) {
            $Image = SiteImage::where('id', $request->id)->first();
            $Image->name = $request->get('name');
            $Image->title = $request->get('title');
            $Image->image_hight = $request->get('image_hight');
            $Image->image_width = $request->get('image_width');

            if ($request->hasFile('image')) {
                $exe = $request->file('image')->getClientOriginalExtension();
                if (!empty($request->image_croped) && isset($request->image_croped)) {
                    $cropped_img_b64 = $request->image_croped;
                     @unlink(public_path('images/' . $Image->name));
                    $urls = getcwd();
                    $url = str_replace("\\", "/", $urls);
                    $destinationPath = 'images/';
                    $imgname = $Image->name.'_'.mt_rand().'.'. $exe;
                    $data =base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
                    file_put_contents($url."/".$destinationPath.$imgname, $data);
                    $filename =  $destinationPath . '' . $imgname;
                    $Image->src = $imgname;
                }
            }

            $affected_row = $Image->save();

            if (!empty($affected_row)) {
                $responce = ['status' => 1 , 'message' => 'Record successfully updated'];
            } else {
                $responce = ['status' => 0 , 'message' => 'error in updation'];
            }
        } else {
            $responce = ['status' => 2 , 'errors' => $validator->errors()];
        }
        return \Response::json($responce);
    }

    // end class
}
