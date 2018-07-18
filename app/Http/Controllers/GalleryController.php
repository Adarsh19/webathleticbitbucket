<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Gallery;
use Image;

class GalleryController extends Controller
{
    
  /**
   * Gallery index
   *
   * @return view
   */ 
	public function index()
    {
        # code...
        // $clients = Story::where(['publication_status' => 1])->orderBy('created_at', 'desc')->paginate(3);
     //    $stories = Story::where(['publication_status' => 1])->orderBy('created_at', 'asc')->paginate(3);
     //    return view('pages.client', compact('clients', 'stories'));
    }


  /**
   * Show gallery data by id
   *
   * @param integer $id
   * @return JSON
   */
	public function show($id)
    {
        $gallery = Gallery::where('id', $id)->first();
        return \Response::json($gallery);
    }

	
  /**
   * Update gallery data by id
   *
   * @param Request $request
   * @param integer $id
   * @return JSON
   */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        $validator = $validator = Validator::make($request->all(), [
            'caption' => 'required|max:250',
            'publication_status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
        ], [
            'caption.required' => 'Caption is required.',
        ]);

        if ($validator->passes()) {
            $gallery->caption = $request->get('caption');
            $gallery->publication_status = $request->get('publication_status');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_name = $this->image($gallery->id, $image);
                $gallery->image = $file_name;
            }

            if (!empty($request->image_croped) && isset($request->image_croped)) {
                $cropped_img_b64 = $request->image_croped;
                $urls = getcwd();
                $url = str_replace("\\", "/", $urls);
                $destinationPath = 'gallery_image/';
                $imgname = 'thumb_'.$gallery->image;
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
                file_put_contents($url."/".$destinationPath.$imgname, $data);
                $filename =  $destinationPath . '' . $imgname;
                $gallery->thumb = $imgname;
            }


            $affected_row = $gallery->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Gallery update successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return \Response::json(['success' => '1']);
        }
        return \Response::json(['errors' => $validator->errors()]);
    }


  /**
   * Create a new image
   *
   * @param integer $id
   * @param string $image
   * @return string
   */
    public function image($id, $image)
    {
        $filename = $id . '.jpg';
        $location = 'gallery_image/'.$filename;
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
}
