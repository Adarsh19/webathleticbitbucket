@extends('layouts.app')
@section('title', 'Home')

@section('style')
@endsection

@section('content')

   <main>

        <!-- <section class="introduction">
            <div class="row">
                <div class="col-lg-6 tekst">
                    <h2>
                        plan je kennismakingsgesprek
                    </h2>
                    <h1>
                        of stel hieronder je vraag
                    </h1>
                </div>
                <div class="col-lg-6 image">
                    <img src="images/frits_bw.png" alt="">
                </div>
            </div>
        </section> -->

        <section class="contact-form">
            <div class="heading-container">
                <h2 class="theme-heading-2">NEEM CONTACT MET ONS OP</h2>
            </div>

            <div class="row form-row">
                <div class="col-lg-12">
                    <p>VOOR WELKE VRAAG DAN OOK, WIJ STAAN VOOR U KLAAR! WILT U EEN INTAKE PLANNEN? LAAT HIERONDER UW GEGEVENS ACHTER

                    </p>
                    @if ($errors->any())
			            <div class="alert alert-danger">
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif
			        
			        @if (session('success'))
			        <div class="alert alert-success">
			            {{ session('success') }}
			        </div>
			        @endif

                    <form method="post" action="@if($is_company) {{ route('contactFormRouteSluggish', $company_data['slug']) }} @else {{ route('contactFormRoute') }} @endif">
                    	{{ csrf_field()}}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Naam</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="jouw naam hier" name="name">
                            <small id="emailHelp" class="form-text text-muted">we hebben je naam nodig voor antwoord</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-Mail</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="jouw naam hier" name="email">
                            <small id="emailHelp" class="form-text text-muted">we zullen uw e-mail nooit met anderen delen</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Onderwerp</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="geef onderwerp" name="onderwerp">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Bericht</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bericht"></textarea>
                        </div>
                        <button type="submit" class="theme-btn">Submit</button>
                    </form>
                </div>
            </div>


        </section>


    </main>


@endsection
