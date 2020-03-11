@extends('layouts.base')

@section('create')

<style>

            body {
                 background-color: #1248a5;
                 }
            .main-create{

            }
            .main-create-content
            {
              margin: auto;
              width: 70%;
              padding: 2px;
              background: rgba(0,0,0,.5);
              box-sizing: border-box;
              box-shadow: 0 15px 25px rgba(2,2,2,.3);
              border-radius: 10px;
            }
            .main-create-content h1 {

                    color: #fff;
                    text-align: center;
                }

                .main-create-content  input {
                      width: 100%;
                      padding: 5px 0;
                      font-size: 1.2em;
                      color: #fff;
                      margin-bottom: 5px;
                      border: none;
                      border-bottom: 1px solid #fff;
                      outline: none;
                      background:transparent;
                  }

                   .main-create-content label
                   {
                      padding: 2px 5px;
                      font-size: 1.2em;
                      color: #fff;
                      transition: .5s;
                    }

                    .main-create-content .check-container
                   {
                     padding: 3px;
                     background: #fff;
                     border-radius: 5px;
                    }

                    .main-create-content .form-check label
                   {
                    color: black;
                    }
                    .main-create-content .form-check input
                   {
                     height: 25px;
                    width: 25px;
                    background-color: #eee;
                    }
</style>
@include('components.header')

<main class="main-create nav-fix py-5">
  <div class="container main-create-content py-5">
    <div class="row">
      <div class="col-10">
        <h1>Inserisci un nuovo appartamento</h1>
      </div>
      <div class="col-10">

      </div>
      <div class="col-10 offset-1">
        <form  method="post" class="addApartForm" enctype="multipart/form-data">

          <div class="form-group">
            <label for="formControlFile1">Inserisci immagine</label>
            <input type="file" class="form-control-file" name="imagefile" id="formControlFile1">
          </div>

          <div class="form-group">
              <label for="description">Titolo</label>
              <input value="" id="apart-title" class="form-control" name="title" type="text" placeholder="Inserisci titolo"
              required data-parsley-maxlength="80" data-parsley-trigger="keyup"/>
          </div>

          <div class="form-group">
              <label for="description">Descrizione</label>
              <input value="" id="apart-description" class="form-control" name="description" type="text" placeholder="Inserisci descrizione"
              required data-parsley-maxlength="850" data-parsley-trigger="keyup"/>
          </div>

          <div class="form-group">
              <label for="address">Indirizzo</label>
              <input value="" id="apart-address" class="form-control" name="address" type="text" placeholder="Inserisci un indirizzo"
              required data-parsley-maxlength="255" data-parsley-trigger="keyup"/>
          </div>

          <div class="form-group">
              <label for="rooms">Stanze</label>
              <input value="" id="apart-rooms" class="form-control" name="rooms" type="text" placeholder="Inserisci il numero di stanze"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="beds">Letti</label>
              <input value="" id="apart-beds" class="form-control" name="beds" type="text" placeholder="Inserisci il numero di letti"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="bath">Bagni</label>
              <input value="" id="apart-bath" class="form-control" name="bath" type="text" placeholder="Inserisci il numero di bagni"
              required data-parsley-type="integer" data-parsley-range="[1, 200]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>
          <div class="form-group">
              <label for="square_mt">Metri quadri</label>
              <input value="" id="apart-square_mt" class="form-control" name="square_mt" type="text" placeholder="Inserisci i metri quadrati"
              required data-parsley-type="integer" data-parsley-range="[1, 10000]" data-parsley-trigger="keyup"
              data-parsley-range-message="exceed the maximum limit" />
          </div>

          <div class="check-container">
            <div class="form-group">
              @foreach ($configs as $config)
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="configs_id[]" value="{{ $config->id }}">
                      <label class="form-check-label">
                          {{ $config->service }}
                      </label>
                  </div>
              @endforeach
            </div>
         </div>


          <div class="form-group">
            <label for="show">Rendi l'annuncio visibile a tutti?</label>
            <select class="form-control" name="show">
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
          </div>

          <div class="form-group">
              <input type="submit" class="btn btn-primary apartment-submit" value="Create" />
          </div>
        </form>
      </div>


    </div>
  </div>
</main>
@include('components.footer')
@endsection
