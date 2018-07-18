<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;
use Carbon\Carbon;
use Auth;
use URL;
use DB;

class Helper extends Model
{




/*
**
** Use For: Display footer page.
** Use In: layouts/footer.blade.php
** Function : getFooterLinks();
*/
    static function getFooterLinks($category)
    {
        $pages = DB::table('pages')->where('category', $category)
                                   ->select('page_name', 'id')
                                   ->get();
        return $pages;
    }



/*
**
** Use For : render the Site Images in blade files
** Use In : welcome.blade, client , header ,footer etc .
** Function: renderSiteImage();
**
*/

    static function renderSiteImage($id = null)
    {
        if (!empty($id)) {
            $getRecord = DB::table('site_images')->select('*')
                           ->where('id', '=', $id)
                           ->first();

            if (!empty($getRecord)) {
                if (Auth::user() && Auth::user()->role == 'admin') {
                    echo '<img src="'.url('/images').'/'.$getRecord->src.'" data-image_data=\''.json_encode($getRecord).'\' class="site_images" >';
                } else {
                    echo '<img src="'.url('/images').'/'.$getRecord->src.'"  >';
                }
            }
        }
    }


/*
**
** Use : Update the Site Images. UserController
** Use in : UserController
**
*/
    static function saveSiteImage($base64_src, $destinationPath, $id)
    {
        # code...
            $record_exist = Company::where('id', $id)->first();
        if ($record_exist) {
            $cropped_img_b64 = $base64_src;
            $urls = getcwd();
            $url = str_replace("\\", "/", $urls);
            $imgname = $id.'_'.mt_rand().'.jpg';
            //$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
            //file_put_contents($url."/".$destinationPath.$imgname, $base64_src);
            $filename =  $destinationPath . '' . $imgname;
            $base64_src->move($destinationPath, $imgname);
            @unlink(public_path($destinationPath . $record_exist->logo));
            $record_exist->logo = $imgname;
            $record_exist->save();
            return $imgname;
        } else {
            return false;
        }
    }

/*
**
** Use : Update the Site Images.
** Use In : UserController
**
*/
    static function saveProfileImage($base64_src, $destinationPath, $id)
    {
        # code...
            $user = User::where('id', $id)->first();
        if ($user) {
            $cropped_img_b64 = $base64_src;
            $urls = getcwd();
            $url = str_replace("\\", "/", $urls);
            $imgname = $id.'_'.mt_rand().'.jpg';
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_img_b64));
            file_put_contents($url."/".$destinationPath.$imgname, $data);
            $filename =  $destinationPath . '' . $imgname;
            @unlink(public_path($destinationPath . $user->avatar));
            $user->avatar = $imgname;
            $user->save();
            return $imgname;
        } else {
            return false;
        }
    }

/*
**
** Use : Get Site Images. use in admin views
** Function: Admin
**
*/
    static function getSiteImage($image_type)
    {
        
            $getRecord = DB::table('site_images')->where('type', '=', $image_type)->first();
            return  $getRecord ;
    }


/**
 * Calculate for Age.
 */
    static function getAgeAttribute($birthdate)
    {
        return Carbon::parse($birthdate)->age;
    }

    /**
     *Notifications mappings array
     * This will map claases with Messages
     *
     */

    static function mappings($key)
    {

        #We will add all mappings here for all notification types
        $map=array(
            "App\Notifications\TrainingSchemaCreated"=>"Training Schema _ created for you",
        );
        return  $map[$key];
    }
}
