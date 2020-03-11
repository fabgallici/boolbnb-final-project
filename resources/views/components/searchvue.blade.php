<script type="text/x-template" id="searchvue">


        <div class="searchvue container p-0">
            <div class="search__top d-flex w-100">
                <form role="form" class='w-100'>


                    <div role="group" id="coords-disable" class="search__top-wrap d-flex flex-row flex-nowrap align-items-center">
                        <h5 class="px-2">Conosci l'indirizzo dell'apparmento? inserisicilo qui <i class="far fa-hand-point-right bh-icon"></i></h5>
                        <div class="px-3 input-tomtom flex-grow-1">
                            <input type="text" class="form-control" v-on:keyup="evData()" v-model="alt_search_field" id="vue-alt-search" placeholder="Inserisci indirizzo"/>
                        </div>
                        <div class="px-3 input-tomtom d-flex align-items-center">
                            <select class="p-2" v-on:change="evData()" v-model="range" id="vue-range">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <label for="vue-range"  class="label-tomtom px-3"> cerca entro <br>(in km)</label>
                        </div>
                    </div>

                </form>
            </div>


            <div class="container-fluid search__bottom d-md-flex m-0 p-0">

                <div class="search__bottom-left col-12 col-md-3" >
                    <div class="quick-search p-2 m-0">
                        <div class="form-group d-flex flex-column">
                            <label class="p-1" for="vue-search_field">Ricerca rapida</label>
                            <input type="text" class="form-control inputsrc" v-on:keyup="evData()" v-model="search_field" id="vue-search_field"/>
                            <h5 class="px-3">@{{ res_num }} </h5>
                        </div>
                    </div>
                    <div class="option-search p-2 m-0" >

                        <div class="div-num-input d-flex px-0 py-2">
                            <label class="input-label-style m-0 p-2 flex-grow-1" for="vue-rooms">+ stanze:</label>
                            <div class="d-flex input-num-style">
                                <input class="input-num" v-on:keyup="evData()" v-model="rooms" id="vue-rooms" type="number" step="1" min="1" max="50">
                                <div class='num-arrow'>
                                    <span id='num-up' v-on:click="updateNum()" data-finder="rooms_up"></span>
                                    <span id='num-down' v-on:click="updateNum()" data-finder="rooms_down"></span>
                                </div>
                            </div>
                        </div>

                        <div class="div-num-input d-flex px-0 py-2">
                            <label class="input-label-style m-0 p-2 flex-grow-1" for="vue-beds">+ letti:</label>
                            <div class="d-flex input-num-style">
                                <input class="input-num" v-on:keyup="evData()" v-model="beds" id="vue-beds" type="number" step="1" min="1" max="50">
                                <div class='num-arrow'>
                                    <span id='num-up' v-on:click="updateNum()" data-finder="beds_up"></span>
                                    <span id='num-down' v-on:click="updateNum()" data-finder="beds_down"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group check-search p-2 m-0">
                        <div v-for='config in configObj' class="form-check form-check-inline d-flex flex-column align-items-start p-2">
                            <div class="d-flex flex-row align-items-center">
                                <input type="checkbox" :value='config.id' v-model="checkedConfigs" class="form-check-input config-checkbox" @change="evData()">
                                <span class="px-2" ><i :class="config.icon"></i></span>
                                <label class="m-0" for="config-checkbox">@{{config.service}}</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="search__bottom-right d-md-flex flex-column col-md-9 col-xl-9">
                        <single-apartment v-for='(apartment, index) in apartments' :key="index" :apartment='apartment'></single-apartment>
                </div>
            </div>
        </div>





</script>

<script type="text/javascript">
    Vue.component('searchvue', {
        template: "#searchvue",
        data() {
        return {
            api_key : 'eHsDmslbcIzT8LG5Yw54AH9p2munbhhh',
            CSRF_TOKEN : '',
            auth_user: '',
            baseUrl: window.location.protocol + "//" + window.location.host + "/",
            search_field: '',
            alt_search_field: '',
            rooms:1,
            beds:1,
            lat: '',
            lon: '',
            range: 20,
            route_show: '',
            searchDone: {},
            searchString: '',
            apartments: [],
            configs: [],
            checkedConfigs: [],
            res_num: '',
            configObj:[],
        };
        }
        ,
        watch: {
        search_field: function() {
            if (this.search_field.length > 0) {
            $('#coords-disable :input').prop("disabled", true);
            } else {
            $('#coords-disable :input').removeAttr("disabled");
            }
        }
        },
        created() {

        this.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        this.search_field = $('#data_search_field').attr('data-search');
        this.auth_user = $('#data_search_field').attr('data-user');
        this.getAparts();
        this.getAllConfigs();
        },
        methods: {
            getAllConfigs() {
                axios.get(this.baseUrl+'search/configs').then(resp => {
                    // console.log('configs ', resp);
                    if(resp.status == 200) {
                        this.configs = resp.data;
                        this.buildConfigObj();
                    }
                })
                .catch(err => {
                    this.error = "Error downloading configs";
                    console.log('err', err)
                });
            },
            evData() { // da controllare, alt sost tutti eventi v-on e @change con getAparts()
                if(this.search_field.length >=1) {
                    this.getAparts();
                } else if (this.alt_search_field.length >=1) {
                    this.getCoords();
                }
                else {
                    this.res_num = 'Inserire i parametri corretti';
                    this.apartments = [];
                    this.searchString = '';
                }

            },
            getCoords() {
                window.axios.defaults.headers.common = {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                };
                axios.get("https://api.tomtom.com/search/2/geocode/" + this.alt_search_field + ".json?limit=1&key=" + this.api_key)
                .then(resp => {
                    // console.log('configs ', resp);
                    if(resp.status == 200) {
                        console.log('coord resp', resp);
                        if (resp.data.results.length != 0) {
                            var position = resp.data.results[0].position;
                            this.lat = position.lat;
                            this.lon = position.lon;
                            this.getAparts();
                        }

                    }
                })
                .catch(err => {
                    this.error = "Error downloading configs";
                    console.log('err', err)
                });
            },
            getAparts() {
                this.apartments = [];
                axios.post(this.baseUrl + 'search', {
                    search_field: this.search_field,
                    rooms: this.rooms,
                    beds: this.beds,
                    lat: this.lat,
                    lon: this.lon,
                    range: this.range,
                    configs: this.checkedConfigs
                })
                .then(res => {
                    // console.log('apartments ', res);

                    const data = res.data;
                    if (data.success == true) {
                        this.apartments = data.data;
                        // console.log('apartments ', this.apartments);
                        this.addIcon();
                        // this.updateResults(data.searchFor);
                    } else {
                        console.log('success false');
                        // this.updateResults('');
                    }
                    if(this.apartments.length == 1) {
                        this.res_num = '1 Risultato trovato';
                    } else if (this.apartments.length > 0){
                        this.res_num = this.apartments.length + ' Risultati trovati';

                    }  else {
                        this.res_num = 'Nessun Risultato trovato';
                    }
                    console.log('ajax call: ', this.res_num);

                })
                .catch(err => {

                    this.error = "Error downloading ";
                    console.log('err', err)
                });
            },
            addIcon() {
                this.apartments.forEach( apart => {
                    for(var i=0; i<apart.configs.length; i++) {
                        var config = apart.configs[i];
                        switch(config.service) {
                            case 'wifi':
                                config.icon = "fas fa-wifi";
                                break;
                            case 'parking':
                                config.icon = "fas fa-parking";
                                break;
                            case 'pool':
                                config.icon = "fas fa-swimming-pool";
                                break;
                            case 'reception':
                                config.icon = "fas fa-concierge-bell";
                                break;
                            case 'sauna':
                                config.icon = "fas fa-hot-tub";
                                break;
                            case 'sight':
                                config.icon = "fas fa-eye";
                                break;
                            default:
                                break;
                        }

                }
                });

                // console.log('ADDED ICONS', this.aptConfigs);
            },
            updateNum(){
                e_obj = event.target
                finder = e_obj.getAttribute('data-finder');
                if(finder.includes('rooms')){
                    finder=='rooms_up'? this.rooms++ : this.rooms == 1 ? this.rooms=1 : this.rooms--;
                } else if(finder.includes('beds')){
                    finder=='beds_up'? this.beds++ : this.beds == 1 ? this.beds=1 : this.beds--;
                }
                this.evData()
            },
            buildConfigObj(){
                let fa_icons =[
                    'fas fa-wifi',
                    'fas fa-parking',
                    'fas fa-swimming-pool',
                    'fas fa-concierge-bell',
                    'fas fa-hot-tub',
                    'fas fa-eye',
                ]
                this.configs.forEach((el,i) => {
                    this.configObj.push({
                        id:el.id,
                        service: el.service,
                        icon: fa_icons[i]
                    })
                });
                // console.log('configurazioni' ,this.configObj)
            }
        }
    });

</script>
