<div class="col-md-12 row" style="margin-bottom: 18px;">

    <div class="col-md-3 ">

        <?php
        $goals=\App\ExerciseGoal::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        $goooals_html='<select class="form-control" name="goal" onchange="searchFilter()">';
        $goooals_html.='<option value="">Bepaal doel</option>';
        foreach ($goals as $goal) {
            $selected="";
            if ($userfilter_info->goal==$goal->id) {
                $selected="selected";
            }
            $goooals_html.='<option '.$selected.' value="'.$goal->id.'">'.$goal->goalname.'</option>';
        }
        echo $goooals_html.='</select>';
        ?>


    </div>
    <div class="col-md-3 ">

        <?php
        $traininglevels=\App\ExerciseTrainingLevel::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        $traininglevels_html='<select class="form-control" name="traininglevel" onchange="searchFilter()">';
        $traininglevels_html.='<option value="">Kies trainingniveau</option>';
        foreach ($traininglevels as $traininglevel) {
            $selected="";
            if ($userfilter_info->traininglevel==$traininglevel->id) {
                $selected="selected";
            }
            $traininglevels_html.='<option '.$selected.' value="'.$traininglevel->id.'">'.$traininglevel->traininglevel.'</option>';
        }
        echo $traininglevels_html.='</select>';
        ?>


    </div>
    <div class="col-md-3">

        <?php
        $traininglevelsmg=\App\ExerciseAccentMuscleGroup::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        $traininglevelsmg_html='<select class="form-control" name="musclegroupname" onchange="searchFilter()">';
        $traininglevelsmg_html.='<option value="">Focus spiergroep</option>';
        foreach ($traininglevelsmg as $traininglevelsm) {
            $selected="";
            if ($userfilter_info->musclegroupname==$traininglevelsm->id) {
                $selected="selected";
            }
            $traininglevelsmg_html.='<option '.$selected.' value="'.$traininglevelsm->id.'">'.$traininglevelsm->musclegroupname.'</option>';
        }
        echo $traininglevelsmg_html.='</select>';
        ?>


    </div>
    <div class="col-md-2 ">

        <?php
        $materials=\App\ExerciseMaterial::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        $materials_html='<select class="form-control" name="materiallevel" onchange="searchFilter()">';
        $materials_html.='<option value="">Kies materiaal</option>';
        foreach ($materials as $material) {
            $selected="";
            if ($userfilter_info->materiallevel==$material->id) {
                $selected="selected";
            }
            $materials_html.='<option '.$selected.' value="'.$material->id.'">'.$material->materiallevel.'</option>';
        }
        echo $materials_html.='</select>';
        ?>


    </div>



    <div class=" col-md-1">
        <div style="margin: 0 auto">
            <i class="rotator fa fa-refresh fa-spin"></i>
        </div>

    </div>




</div>
