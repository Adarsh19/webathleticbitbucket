@extends('layouts.app')
@section('title', 'Service')
@section('style')
<style type="text/css">
    .service-card-footer{
        padding-top: 15px;
        padding-bottom: 15px;
    }
</style>
@endsection
@section('content')
<main class="services">
<h1 class="theme-heading">PERSOONLIJKE HULP</h1>
<div class="theme-line"></div>
<section class="card-container">
    <?php $i=0; foreach ($packages as $p) { ?>
    <div class="service-card<?php if ($i == 1) {
                echo " selected";
            }
?>" data-aos="<?php if ($i == 0) {
        echo "fade-left";
}if ($i == 1) {
    echo "zoom-in";
}if ($i == 2) {
    echo "fade-right";
}
?>" style="margin-bottom:30px;">
        <div class="service-card-header">
            <p><?php echo Ucwords($p->service); ?></p>
        </div>
        <div class="service-card-subheader">
            <p class="price">€ <?php echo $p->Start_fee; ?>,-<span>/<?php $time = $p->days;
            echo $time; ?> days</span></p>
            <small style="color:#616161;">Incl. BTW</small>
        </div>
        <div class="service-card-body">
            <ul>
            <?php $string = explode('.', $p->sdescription);
            foreach ($string as $ps) { ?>
                <li style="color:#616161;"><?php echo $ps; ?></li>
            <?php } ?>
            </ul>
        </div>
        <div class="service-card-footer">
            <div class="button-container" style="text-align: center;">
                <a href="#" class="theme-btn package-btn" data-id="<?php echo $p->id; ?>">REGISTER WITH THIS PACKAGE</a>
            </div>
        </div>    
    </div>
        <?php $i++;
        if ($i == 3) {
            $i = 0;
        }
    } ?>
</section>
<div class="modal fade" id="signup-modal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{url('signup2')}}" id="sign-up-form">
            <section class="signup-form theme-form" style="margin:0;width:100%;">
                <div class="form-header">
                    <h3>Please fill in all of info to proceed</h3>
                </div>
                <div class="form-body">
                    <div class="step-personal-info step" style="display: block;">
                        <div class="form-group">
                            <p class='error_message' style="color:red"></p>
                        </div>
                        <div class="form-group">
                            <label for="userName">Uw naam</label>
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" class="form-control" name="package_id" id="package_id" value="">
                            <input type="text" class="form-control" name="username" id="userName" aria-describedby="userNameHelp" placeholder="Vul uw naam in">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="userPhone">Telefoonnummer</label>
                            <input type="phone" class="form-control" name="phone" id="userPhone" aria-describedby="userPhoneHelp" placeholder="vul uw Telefoonnummer in">
                            <small id="userPhoneHelp" class="form-text text-muted">We zullen uw Telefoonnummer nooit met iemand anders delen.</small>
                        </div>

                        <div class="form-group">
                            <label for="userEmail">E-mailadres</label>
                            <input type="email" class="form-control" name="email" id="userEmail" aria-describedby="emailHelp" placeholder="vul uw e-mailadres in">
                            <small id="emailHelp" class="form-text text-muted">We zullen uw e-mail nooit met iemand anders delen.</small>
                        </div>


                        <div class="form-group">
                            <label for="userPassword">Wachtwoord</label>
                            <input type="password" class="form-control" name="password" id="userPassword" placeholder="vul uw Wachtwoord in">
                        </div>

                        <div class="form-group">
                            <label for="userPasswordConfirm">Wachtwoord controle</label>
                            <input type="password" class="form-control" name="confirm_password" id="userPasswordConfirm" placeholder="vul uw Wachtwoord in">
                        </div>

                        <button type="submit" class="btn btn-warning white" >Verder</button>
                    </div>
                </div>
                <div class="form-footer">

                </div>


            </section>
        </form>
      </div>
    </div>
  </div>
<!-- ./contact -->
</main>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        $('.package-btn').click(function(){
            var el = $(this);
            var id = el.attr('data-id');
            $('#package_id').val(id);
            $('#signup-modal').modal('show');
        });

        $("#sign-up-form").submit(function(event){
            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission
            
            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data,
                dataType : 'json',
                success : function(response){
                    if(response.status == 1){
                        window.location.replace(response.redirect);
                    }else{
                        $('.error_message').html(response.message);
                    }
                }
            });
        });

    })
</script>
@endsection
