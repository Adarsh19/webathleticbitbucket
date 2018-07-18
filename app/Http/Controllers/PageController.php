<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Page;
use Image;

class PageController extends Controller
{
    //

    public function show($id)
    {
        $page = Page::where('id', $id)->first();
        return \Response::json($page);
    }

    /**
     * Update
     * 
     * @param Request $request
     * @return JSON
    */
	public function update(Request $request, $id)
    {
        $page = Page::find($id);
        if ($page->page_slug == $request->page_slug) {
            $page_slug = "required|alpha_dash|min:5|max:150";
        } else {
            $page_slug = "required|alpha_dash|min:5|max:150|unique:pages";
        }

        $validator = $validator = Validator::make($request->all(), [
            'page_name' => 'required|max:250',
            'page_slug' => $page_slug,
            'page_content' => 'required|string',
            'publication_status' => 'required',
            'page_featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240|dimensions:max_width=5000,max_height=3000',
            'meta_title' => 'required|max:250',
            'meta_keywords' => 'required|max:250',
            'meta_description' => 'required|max:400',
        ], [
            'page_name.required' => 'Page name is required.',
        ]);

        if ($validator->passes()) {
            $page->page_name = $request->get('page_name');
            $page->page_slug = $request->get('page_slug');
            $page->page_content = $request->get('page_content');
            $page->publication_status = $request->get('publication_status');
            $page->meta_title = $request->get('meta_title');
            $page->meta_keywords = $request->get('meta_keywords');
            $page->meta_description = $request->get('meta_description');

            if ($request->hasFile('page_featured_image')) {
                $image = $request->file('page_featured_image');
                $file_name = $this->page_featured_image($page->id, $image);
                $page->page_featured_image = $file_name;
            }

            if (!empty($request->image_croped) && isset($request->image_croped)) {
                $cropped_img_b64 = $request->image_croped;
                $urls = getcwd();
                $url = str_replace("\\", "/", $urls);
                $destinationPath = 'page_image/';
                if (!empty($page->page_featured_image)) {
                    $imgname = 'thumb_'.$page->page_featured_image;
                } else {
                    $imgname = 'thumb_'.time().'.png';
                }
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
                file_put_contents($url."/".$destinationPath.$imgname, $data);
                $filename =  $destinationPath . '' . $imgname;
                $page->thumb = $imgname;
            }


            $affected_row = $page->save();

            if (!empty($affected_row)) {
                $request->session()->flash('message', 'Page update successfully.');
            } else {
                $request->session()->flash('exception', 'Operation failed !');
            }
            return \Response::json(['success' => '1', 'page' => $page]);
        }
        return \Response::json(['errors' => $validator->errors()]);
    }


	/**
     * Page featured image
     * 
     * @param integer $id
     * @param string $image
     * @param string $extension
     * @return JSON
    */
    public function page_featured_image($id, $image, $extension = null)
    {
        $filename = $id . '.' . ($extension ?: @$image->getClientOriginalExtension() ?: 'jpg');
        $location = get_page_featured_image_path($filename);
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
        $background->insert($img, 'center');
        $background->save($location);
        return $filename;
    }
}
