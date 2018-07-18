@extends('layouts.app')
@section('title', 'Signup')
@section('style')
@endsection
@section('content')
    <main class="signup-page">
        <section class="signup-heading">
            <h1 class="theme-heading">Aanmelden</h1>
            <div class="theme-line"></div>
        </section>
        <ul class="step-form">
            <li class="step-info covered">Je gegevens</li>
            <li class="step-type">Je coachingstraject</li>
            <li class="step-payment">De betaling</li>
        </ul>
        <form action="{{ url('/verifySignup') }}" method="POST">
        {{ csrf_field()}}
            <section class="signup-form theme-form">
                <div class="form-header">
                    <h3>Please fill in all of info to proceed</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="form-body">
                    <div class="step-personal-info step" id="step1signup">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Aanhef</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="exampleFormControlSelect1">
                              <option value="Dhr">Dhr</option>
                              <option value="Mvr">Mvr</option>
                            </select>
                            <span class="error" style="color:orange; " id="slerror"></span>
                        </div>
                        <div class="form-group">
                            <label for="userName">Uw naam</label>
                            <input type="text" class="form-control" id="userName" name="username" aria-describedby="userNameHelp" placeholder="Vul uw naam in">
                            <small id="nameHelp" class="form-text text-muted"></small>
                            <span class="error" style="color:orange; " id="userNameerror"></span>
                        </div>
                        <div class="form-group">
                            <label for="userPhone">Telefoonnummer</label>
                            <input type="phone" class="form-control" id="userPhone" name="phone" aria-describedby="userPhoneHelp" placeholder="vul uw Telefoonnummer in">
                            <small id="userPhoneHelp" class="form-text text-muted">We zullen uw Telefoonnummer nooit met iemand anders delen.</small>
                            <span class="error" style="color:orange; " id="userPhoneerror"></span>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">E-mailadres</label>
                            <input type="email" class="form-control" id="userEmail" name="email" aria-describedby="emailHelp" placeholder="vul uw e-mailadres in">
                            <small id="emailHelp" class="form-text text-muted">We zullen uw e-mail nooit met iemand anders delen.</small>
                            <span class="error" style="color:orange; " id="userEmailerror"></span>
                        </div>
                        <div class="form-group">
                            <label for="userPassword">Wachtwoord</label>
                            <input type="password" class="form-control" id="userPassword" name="password" placeholder="vul uw Wachtwoord in">
                            <span class="error" style="color:orange; " id="userPassworderror"></span>
                        </div>
                        <div class="form-group">
                            <label for="userPasswordConfirm">Wachtwoord controle</label>
                            <input type="password" class="form-control" id="userPasswordConfirm" placeholder="vul uw Wachtwoord in">
                            <span class="error" style="color:orange; " id="userPasswordConfirmerror"></span>
                        </div>
                        <button type="button" class="btn btn-warning white" onclick="showStep(1);">Verder</button>
                    </div>
                    <div class="step-coaching-info step" id="step2signup">
                        <div class="form-group">
                            <label for="userStartDate">Kies startdatum:</label>
                            <input type="date" class="form-control" id="userStartDate" name="userStartDate" value="">
                            <span class="error" style="color:orange; " id="userStartDateerror"></span>
                        </div>
                        <h4>Minimale tijdsduru van een coachingstraject is 20 weken.</h4>
                        <div class="form-group">
                            <select class="form-control" id="package" name="package" <?php if(Request::segment(2)){ echo "readonly"; } ?>>
                                @foreach($packages as $p)
                                <option value="<?php echo Ucwords($p->id); ?>">
                                    <p><?php echo Ucwords($p->service); ?></p>
                                    <div class="form-check">
                                        <label class="form-check-label">(€) <?php echo $p->Start_fee; ?>, per <?php echo $p->days; ?> days</label>
                                    </div>
                                </option>
                                @endforeach
                            </select>
                            <span class="error" style="color:orange; " id="packageerror"></span>
                        </div>
                        <div class="form-group">
                            <label for="signature">uw handtekening</label>
                            <canvas id="signature" class="canvas" width="250" height="100"></canvas>
                            <button id="clear-signature" class="btn btn-sm btn-secondary">Verwijder handtekening</button>
                            <input type="hidden" value="" name="sign" id="sign">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">Ik ga akkoord met de <a href="http://dev.webathletic-coaching.nl/algemene-voorwaarden">algemene voorwaarden</a></label>
                            <span id="defaultCheck1error" style="color:orange; " class="error"></span>
                        </div>
                        <button type="button" class="btn btn-warning white" onclick="showStep(0);">Terug</button>
                        <button type="button" class="btn btn-warning white" onclick="showStep(2);">Verder</button>
                    </div>
                    <div class="step-payment-info step" id="step3signup">
                        <p>Payment method need Integration</p>
                        <button type="button" class="btn btn-warning white" onclick="showStep(1);">Terug</button>
                        <button type="submit" class="btn btn-warning white">Voorleggen</button>
                    </div>
                </div>
                <div class="form-footer">
                </div>
            </section>
        </form>
        <!-- ./contact -->
    </main>
<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.signature.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script src="{{ asset('js/jquery.signature.js')}}"></script>
<script>
    $(document).ready(function($){
        var canvas = document.getElementById("signature");
        var signaturePad = new SignaturePad(canvas);
        var json = $('#signature').signature({syncField: '#signatureJSON'});
        var JPEG = $('#signature').signature('option', 'syncFormat', "JPEG");
        $("#sign").val(JSON.stringify(JPEG));
        $('#clear-signature').on('click', function(){
            signaturePad.clear();
            return false;
        });
    });
</script>
<script>
$(document).ready(function ($) {
    var currentStep = 0;
    showStep(currentStep);
});
function showStep(n) {
    $(".error").html('');
    var temp = 0;
    if(n == '1'){
        var sl = $("#exampleFormControlSelect1").val();
        var userName = $("#userName").val();
        var userPhone = $("#userPhone").val();
        var userEmail = $("#userEmail").val();
        var userPassword = $("#userPassword").val();
        var userPasswordConfirm = $("#userPasswordConfirm").val();
        if(sl == ""){
            temp++;
            $("#slerror").html('Required.');
        }
        if(userName == ""){
            temp++;
            $("#userNameerror").html('Required.');
        }
        if(userPhone == ""){
            temp++;
            $("#userPhoneerror").html('Required.');
        }
        if(userEmail == ""){
            temp++;
            $("#userEmailerror").html('Required.');
        }
        if(userPassword == ""){
            temp++;
            $("#userPassworderror").html('Required.');
        }
        if(userPasswordConfirm == ""){
            temp++;
            $("#userPasswordConfirmerror").html('Required.');
        }
        if(userPasswordConfirm != "" && userPassword != ""){
            if(userPasswordConfirm != userPassword){
                temp++;
                $("#userPasswordConfirmerror").html('Password and confirm password not match.');
            }
        }
        if(temp == 0){
            $('.step-fomr li').removeClass('covered');
            var form_progress = $('.step-form li');
            form_progress[n].className += " covered";
            var form_steps = $('.step');
            $('.step').css({
                'display': 'none'
            });
            form_steps[n].style.display = "block";
        }
    }
    if(n == '2'){
        if($("#defaultCheck1").prop('checked') == false){
            temp++;
            $("#defaultCheck1error").html('Check the checkbox to agree with terms and conditions.');
        }
        if($("#package").val() == ""){
            temp++;
            $("#packageerror").html('Required.');
        }
        if($("#userStartDate").val() == ""){
            temp++;
            $("#userStartDateerror").html('Required.');
        }
        if(temp == 0){
            $('.step-fomr li').removeClass('covered');
            var form_progress = $('.step-form li');
            form_progress[n].className += " covered";
            var form_steps = $('.step');
            $('.step').css({
                'display': 'none'
            });
            form_steps[n].style.display = "block";
        }
    }
}
</script>
@endsection
@section('script')
@endsection