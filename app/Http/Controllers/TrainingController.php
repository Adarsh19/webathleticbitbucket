<?php

namespace App\Http\Controllers;

use App\ExerciseAccentMuscleGroup;
use App\ExerciseGoal;
use App\ExerciseMaterial;
use App\ExerciseTrainingLevel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{

    public function __construct()
    {
        if (Auth::user()) {
            $user = Auth::user();

            if ($user->role == 'user') {
                return redirect()->back()->with(array("fail" => "You have have no authorisation."))->withInput();
            }
        } else {
            return redirect("/")->with(array("fail" => "You have to Login first to access our features."))->withInput();
        }
    }


    public function savetrainingGoal(Request $request, $userid)
    {


        //$userid=Auth::id();
        $is_preseant=ExerciseGoal::where('goalname', 'like', $request->field_name)
            ->where('user_id', $userid)
            ->first();

        if (empty($is_preseant)) {
            $res=ExerciseGoal::create(['goalname'=>$request->field_name,'user_id'=>$userid]);
            if ($res) {
                return redirect()->back()->with("message", "Goal  ".$request->field_name." create successfully");
            } else {
                return redirect()->back()->with("exception", "Some error occurred while saving goal ".$request->field_name);
            }
        } else {
            return redirect()->back()->with("exception", "Goal with name ".$request->field_name." already exists");
        }
    }

    public function savetrainingTrainingLevel(Request $request, $userid)
    {

        //$userid=Auth::id();
        $is_preseant=ExerciseTrainingLevel::where('traininglevel', 'like', $request->field_name)
            ->where('user_id', $userid)
            ->first();
        if (empty($is_preseant)) {
            $res=ExerciseTrainingLevel::create(['traininglevel'=>$request->field_name,'user_id'=>$userid]);
            if ($res) {
                return redirect()->back()->with("message", "Training Level  ".$request->field_name." create successfully");
            } else {
                return redirect()->back()->with("exception", "Some error occurred while saving Training Level ".$request->field_name);
            }
        } else {
            return redirect()->back()->with("exception", "Training Level with name ".$request->field_name." already exists");
        }
    }
    public function savetrainingMaterial(Request $request, $userid)
    {

//        $userid=Auth::id();
        $is_preseant=ExerciseMaterial::where('materiallevel', 'like', $request->field_name)
            ->where('user_id', $userid)
            ->first();
        if (empty($is_preseant)) {
            $res=ExerciseMaterial::create(['materiallevel'=>$request->field_name,'user_id'=>$userid]);
            if ($res) {
                return redirect()->back()->with("message", "Material name  ".$request->field_name." create successfully");
            } else {
                return redirect()->back()->with("exception", "Some error occurred while saving Material name ".$request->field_name);
            }
        } else {
            return redirect()->back()->with("exception", "Material name with name ".$request->field_name." already exists");
        }
    }
    public function savetrainingaccentgroup(Request $request, $userid)
    {

        //$userid=Auth::id();
        $is_preseant=ExerciseAccentMuscleGroup::where('musclegroupname', 'like', $request->field_name)
            ->where('user_id', $userid)
            ->first();
        if (empty($is_preseant)) {
            $res=ExerciseAccentMuscleGroup::create(['musclegroupname'=>$request->field_name,'user_id'=>$userid]);
            if ($res) {
                return redirect()->back()->with("message", "Muscle Group  ".$request->field_name." create successfully");
            } else {
                return redirect()->back()->with("exception", "Some error occurred while saving Muscle Group ".$request->field_name);
            }
        } else {
            return redirect()->back()->with("exception", "Muscle Group with name ".$request->field_name." already exists");
        }
    }


    public function deletetrainingGoal(Request $request, $id = null)
    {


        $userid=Auth::id();
        $is_preseant=ExerciseGoal::where('id', $id)
            ->where('user_id', $userid)
            ->delete();
        if ($is_preseant) {
                return redirect()->back()->with("message", "Goal  deleted  successfully");
        } else {
            return redirect()->back()->with("exception", "Goal not found");
        }
    }

    public function deletetrainingTrainingLevel(Request $request, $id = null)
    {

        $userid=Auth::id();
        $is_preseant=ExerciseTrainingLevel::where('id', $id)
            ->where('user_id', $userid)
            ->delete();
        if ($is_preseant) {
                return redirect()->back()->with("message", "Training Level  deleted successfully");
        } else {
            return redirect()->back()->with("exception", "Training Level not found");
        }
    }
    public function deletetrainingMaterial(Request $request, $id = null)
    {

        $userid=Auth::id();
        $is_preseant=ExerciseMaterial::where('id', $id)
            ->where('user_id', $userid)
            ->delete();
        if ($is_preseant) {
                return redirect()->back()->with("message", "Material name  deleted  successfully");
        } else {
            return redirect()->back()->with("exception", "Material name not found");
        }
    }
    public function deletetrainingaccentgroup(Request $request, $id = null)
    {

        $userid=Auth::id();
        $is_preseant=ExerciseAccentMuscleGroup::where('id', $id)
            ->where('user_id', $userid)
            ->delete();
        if ($is_preseant) {
                return redirect()->back()->with("message", "Muscle Group deleted  successfully");
        } else {
            return redirect()->back()->with("exception", "Muscle Group not found");
        }
    }

    public function updatetrainingGoal(Request $request, $id = null, $userid = null)
    {


        //$userid=Auth::id();
        $is_preseant=ExerciseGoal::where('id', $id)->update(['goalname'=>$request->field_name,'user_id'=>$userid]);
        if ($is_preseant) {
            return redirect()->back()->with("message", "Goal  updated  successfully");
        } else {
            return redirect()->back()->with("exception", "Goal update error");
        }
    }

    public function updatetrainingTrainingLevel(Request $request, $id = null, $userid)
    {

        //$userid=Auth::id();
        $is_preseant=ExerciseTrainingLevel::where('id', $id)->update(['traininglevel'=>$request->field_name,'user_id'=>$userid]);
        if ($is_preseant) {
            return redirect()->back()->with("message", "Training Level  update successfully");
        } else {
            return redirect()->back()->with("exception", "Training Level update error");
        }
    }
    public function updatetrainingMaterial(Request $request, $id = null, $userid)
    {

       // $userid=Auth::id();
        $is_preseant=ExerciseMaterial::where('id', $id)->update(['materiallevel'=>$request->field_name,'user_id'=>$userid]);
        if ($is_preseant) {
            return redirect()->back()->with("message", "Material name  updated  successfully");
        } else {
            return redirect()->back()->with("exception", "Material name update error");
        }
    }
    public function updatetrainingaccentgroup(Request $request, $id = null, $userid)
    {

        //$userid=Auth::id();
        $is_preseant=ExerciseAccentMuscleGroup::where('id', $id)->update(['musclegroupname'=>$request->field_name,'user_id'=>$userid]);
        if ($is_preseant) {
            return redirect()->back()->with("message", "Muscle Group updated  successfully");
        } else {
            return redirect()->back()->with("exception", "Muscle Group update error");
        }
    }


    public function profileupdatecoaching(Request $request, $user = null)
    {



        $update=User::where('id', $user)->update([
            'hoofddoel'=>$request->hoofddoel,
            'letsels'=>$request->letsels,
            'meerinformatie'=>$request->meerinformatie,
            'chronischeziekte'=>$request->chronischeziekte,
            'noodcontact'=>$request->noodcontact,
            'telefoonnummernood'=>$request->telefoonnummernood,
            'checkin_text_accept'=>$request->checkin_text_accept,
            'checkin_text_warning'=>$request->checkin_text_warning,
            'checkin_text_denied'=>$request->checkin_text_denied,
            'goal'=>$request->goal,
            'traininglevel'=>$request->traininglevel,
            'musclegroupname'=>$request->musclegroupname,
            'materiallevel'=>$request->materiallevel,
        ]);

        if ($update) {
            return redirect()->back()->with("message", "Details Successfully updated");
        } else {
            return redirect()->back()->with("exception", "Some error occurred, please try again");
        }
    }
}
