<script type="text/x-template" id="apartment">
    <div class="card flex-row">
        <div class="card__img-wrap d-lg-flex">
            <div class="card__img-div d-lg-flex m-0 p-0">
                <img class ="card__img-photo card-img-top image-fluid" :src='setImage(apartment.image)'/>
            </div>
        </div>
        <div class="card__body-wrap d-flex flex-grow-1 py-3 pl-3 pr-0" style="background-color:#f2f2f2">
            <div class="card__body-text d-lg-flex flex-column pr-2">
                <p class="card__body-title card-text  text-uppercase font-weight-bold m-0 mb-2" >@{{textTrim(25, apartment.title)}}</p>
                <p class="card__body-desc card-text m-0 flex-grow-1">@{{textTrim(50, apartment.description)}}</p>
                <ul class="card__body-configs list-group list-group-horizontal justify-content-start">
                    <li class="card__body-configs--item list-group-item py-0 pr-2" v-for="aptConfig in apartment.configs"><i :class="aptConfig.icon"></i></li>
                </ul>
            </div>
            <div class="card__body-info d-flex flex-column flex-grow-1 justify-content-between align-items-center border-left">
                <div class='likeHeart'>
                    <i class="fa-heart fa-2x bh-icon" :class="state" @click='classToggle()'></i>
                </div>


                <div class="d-flex flex-column align-items-center justify-content-center">
                    <p class="card-text m-0">72.00€</p>
                    <p class="card-text m-0">/notte</p>
                </div>
                <a class="btn btn-primary button-show" :href="showApart(apartment.id)"> Più informazioni</a>
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    Vue.component('single-apartment', {
    template: "#apartment",
    data() {
        return {
            title_trim:'',
            state:'far',
            baseUrl: window.location.protocol + "//" + window.location.host + "/",
            auth_user: '',
        }
    },
    created(){
        this.auth_user = $('#data_search_field').attr('data-user');
        // console.log('AUTH USER', this.auth_user);
    },
    props:{
        apartment:Object
    },
    methods:{
        setImage(img) {
            return img.includes('images/user/') ? this.baseUrl + img : img;
        },
        showApart(id) {
            return this.auth_user ?
            this.baseUrl +"/user/apartment/" + id
            : this.baseUrl +"/apartment/" + id;
        },
        textTrim(num, text){
            return text.length>num ? text.substring(0,num)+'...' : text
        },
        classToggle(){
            this.state = this.state === 'far' ? 'fas':'far'
        },

    }
});
</script>
