<style>
    .img-circle-cus {
        display: block;
        width: 70px;
        height: 70px;
        margin: -25px 0;
        border: 4px solid #fff;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        object-fit: cover;
    }

    .search_users_exercises {
        max-height: 300px;
        overflow: auto
    }

    .margintop {
        margin-top: 10px;
    }
</style>


<div class="" style="background-color:#545454;color:white;padding-bottom: 10px;min-height: 800px">
    <div class="userbar col-md-12" style="margin-bottom: 10px;overflow: auto;min-height: 50px;max-height: 300px">
    </div>
    <hr id="line">


    <div class="col-md-12">


        <div class="search_users_exercises margintop">

        </div>

    </div>

    <div id="cart" class="col-md-12 cart" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>
    </div>


    @if(Request::segment(3) !="predefined-schemas")
    <div class="col-md-12 sortablediv">


        <div class="doprul products-list product-list-in-box sortable_exercises_added">
        </div>


    </div>

    @endif
    @if(Request::segment(3) =="predefined-schemas")
    <div class="col-md-12 schedulelist">

        <div class="schedulelistinner"></div>


    </div>
    @endif

    @if(Request::segment(3) !="predefined-schemas")
    <div class="col-md-12 sortablebuttons" style="padding-top: 20px">

        <button type="button" class="btn btn-danger   add-button" href="" data-toggle="modal"
                data-target="#deleteSchema"><i class="fa fa-trash"></i> Schema verwijderen 
        </button>
        <button type="button" class="btn btn-success   add-button save-btn-cus" href="#" data-toggle="modal"
                data-target="#saveScheduleModal"><i class="fa fa-save"></i> Opslaan
        </button>
    </div>
    @endif


</div>








