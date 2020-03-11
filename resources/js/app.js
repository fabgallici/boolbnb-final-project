/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import parsleyjs for front-end validation
require('parsleyjs');

var funct = require('./components/style.js')
var comps = require('./components/charts.js')

//import validation
//require('./validation.js');
window.Vue = require('vue');

//import tom tom maps
//import tt from '@tomtom-international/web-sdk-maps';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

var api_key = 'eHsDmslbcIzT8LG5Yw54AH9p2munbhhh';
//var api_key = 'GdAAcHg1a6amrwAI2GNKSm3j4RLCLdzj';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

//Refers to form http://localhost:8000/user/aparts/create
function getCoordByAddress(e) {
    e.preventDefault();
    console.log('data submit');
    // var formData = new FormData(this);
    var formData = new FormData($(this)[0]);  //potrebbe risolvere un tipo di errore
    console.log('is image: ', formData.has('imagefile'));
    if (formData.get('imagefile').size == 0) {
        formData.delete('imagefile');  // cancella file immagine vuoto
    }
    // Display the key/value pairs
    // for (var pair of formData.entries()) {
    //     console.log(pair[0] + ', ' + pair[1]);
    // }
    // Display formData values
    // for (var pair of formData.values()) {
    //     console.log(pair);
    // }
    var address = $('#apart-address').serialize().split('=')[1];
    // var address = $('#apart-address').val().replace(/\s/g, "%20"); //alt vers
    var apartUrl = "https://api.tomtom.com/search/2/geocode/" + address + ".json?limit=1&key=" + api_key;
    console.log(apartUrl);
    $.ajax({
        url: apartUrl,
        method: "GET",
        success: function (data) {
            console.log('data', data);
            if (data.results.length != 0) {
                var position = data.results[0].position;
                var lat = position.lat;
                var lon = position.lon;
                formData.append('lat', lat);
                formData.append('lon', lon);
            }

            addNewApart(formData);
        },
        error: function (error) {
            console.log("error", error);
            //posso chiamare addNewApart e salvare dati senza Geoloc
            addNewApart(formData);
        }
    });
}
// send Apartment data with coord to UserApartmentsController@store
function addNewApart(formData) {
    var locURL = window.location.origin
    var urlStore = locURL +"/user/store";
    var urlUpdate = locURL +"/user/update-apt/";
    var url = formData.has('id') ? urlUpdate : urlStore;
    $.ajax({
        url: url,
        enctype: 'multipart/form-data',
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        },
        data: formData
        ,
        success: function (data) {
            console.log("data", data);
            window.location.href = locURL + "/user/apartment/" + data.apart_id;  //redirect finito create
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function formApartValidation() {
    $('.addApartForm').parsley();

    $('.addApartForm').parsley().on('field:error', function (ParsleyField) {
      ParsleyField.$element.addClass('is-invalid');
      console.log('fired error');
    });
    $('.addApartForm').parsley().on('field:success', function (ParsleyField) {
      ParsleyField.$element.removeClass('is-invalid');
    });
    var $createApart = $('.apartment-submit');
    $('.addApartForm').parsley().on('form:error', function () {

      if ($createApart.hasClass('btn-primary')) {
        $('.apartment-submit').removeClass('btn-primary').addClass('btn-danger');
      }
    });

    $('.addApartForm').parsley().on('field:success', function () {

      if ($createApart.hasClass('btn-danger')) {
        $('.apartment-submit').removeClass('btn-danger').addClass('btn-primary');
      }
    }); //comm
  }



  function getApartMap() {
    var coords;
    var dataLat = $('.data-lat').attr("data-lat");
    var dataLon = $('.data-lon').attr("data-lon");
    // console.log('dataLat', dataLat, ' - dataLon', dataLon);
    if (dataLat && dataLon){
        coords = [dataLon, dataLat];
        var map = tt.map({
            container: 'apart-map',
            key: api_key,
            style: 'tomtom://vector/1/basic-main',
            center: coords,
            zoom: 15
        });

        var marker = new tt.Marker().setLngLat(coords).addTo(map);
    }

}

function init() {

    if ($('#app-search').length) {

        var appSearch = new Vue({
            el: '#app-search',
        });
    }

    if ($('.addApartForm').length) {

       formApartValidation();
    }

    $('.addApartForm').submit(getCoordByAddress);

    if($('#apart-map').length) {

        getApartMap();
    }
    funct.buttonChange();
    comps.createCharts();

};

$(document).ready(init);
//

