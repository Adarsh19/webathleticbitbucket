<aside class="side-menu">
        <div class="btn-close">
            <i class="fas fa-times" onclick="sideMenu('close')"></i>
        </div>
        <ul>
            <li><a href="#">Download de app <i class="fas fa-tablet-alt"></i></a></li>
            <li><a href="#">Vell gestelde vragen <i class="fas fa-question"></i></a></li>
            <li><a href="#">Hoe werkt het? <i class="fas fa-chart-line"></i></a></li>
            <li><a href="#">Voorwaarden <i class="fas fa-book"></i></a></li>
        </ul>
    </aside>

@if(!Auth::check())
    <section class="login-modal-bg">

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="login-form">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inloggen</h5>
                        <button type="button" data-dismiss="modal" style="    border: none;
                        width: 25px;
                        height: 25px;
                        BACKGROUND: #FFF;">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="loginEmail">Email address</label>
                            <input type="email" name="email" class="form-control" id="loginEmail" aria-describedby="emailHelp"
                                   placeholder="Vul uw naam in">
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Password">
                            <small><a href="#">Forgot Password</a></small>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Onthoud mij</label>
                        </div>
                        <p class="login-error" style="text-align: center;color: red;"> </p>
                    </div>
                    <div class="modal-footer">
                        <a href="signup.html">Not a Member?</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('common.close')</button>
                        <button type="submit" class="btn btn-warning">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endif
