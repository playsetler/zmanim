<template>

    <main>
        <h5>All media</h5>
        <table v-if="isMediasLoad" class="table table-borderless">
            <thead>
                <tr>
                    <td scope="col" class="table-col-chekbox">
                        <div class="table-select">
                            <Checkbox id="select-all" @change="SelectAllMedias" />
                        </div>
                    </td>
                    <th scope="col"><div class="table-name">NAME</div></th>
                    <th scope="col"><div class="table-time">MODIFIED</div></th>
                    <th scope="col"><div class="table-action">ACTIONS</div></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(media, index) in medias" :key="media.id">
                    <td scope="row" class="table-col-chekbox">
                        <div class="table-select">
                            <input class="form-check-input" type="checkbox" :id="`select-${media.id}`" v-model="selectedMedias" :value="`${ media.id }`">
                            <label class="form-check-label" :for="`select-${media.id}`"></label>
                        </div>
                    </td>
                    <td><div class="table-name"><a href="#" @click.prevent="EditMedia($event, index)">{{ media.title }}</a></div></td>
                    <td><div class="table-time">{{ media.updated_at }}</div></td>
                    <td class="td-action">
                        <div class="table-action">
                            <Dropdown :id="`${media.id}`" :edit="EditMedia" :delete="DeleteMedias" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <Loader v-else />

        <div class="row g-0">
            <div class="col">
                <button class="btn btn-primary mb-3" @click.prevent="AddLayout">Add Media</button>
                <button class="btn btn-secondary mb-3" :disabled="isDeleteDisabled" @click.prevent="DeleteMedias">Delete</button>
            </div>
        </div>

        <Media
            title="Edit media"
            :media="selectedMedia != null ? medias[selectedMedia] : ''"
            :callback="UpdateMedia"
            ref="media"
            :isMediasLoad="isMediasLoad" />
    </main>
</template>

<script>
import Dropdown from '../components/Dropdown.vue';
import Checkbox from '../components/Checkbox.vue';
import Loader from "../components/Loader.vue";
import Media from "../components/Modal.Media.vue";

export default {
    name: "Medias",
    components: { Dropdown, Checkbox, Loader, Media },
    data() {
        return {
            medias: [],
            selectedMedias:[],
            selectedMedia: null,
            isMediasLoad: true
        }
    },

    computed: {
        isDeleteDisabled() {
            return this.selectedMedias.length > 0 ? false : true;
        }
    },

    mounted() {
        this.GetMedias();
    },

    methods: {
        GetMedias: function() {
            this.isMediasLoad = false;
            axios.get(`/api/media/${this.$route.params.mediaType}`).then(response => {
                this.medias = response.data;
                this.isMediasLoad = true;
            }).catch(error => {
                console.log(error.response);
            });
        },

        SelectAllMedias: function(checkbox) {
            if (checkbox.checked) {
                this.medias.forEach((media) => {
                    this.selectedMedias.push(media.id);
                });
            } else {
                this.selectedMedias.splice(0);
            }
        },

        AddMedia: function() {
            this.$router.push({name: "Create"});
        },

        DeleteMedias: function(event, ids = null) {
            var deletedMedias = [];
            if(ids != null) {
                deletedMedias = ids;
            } else {
                deletedMedias = Array.from(this.selectedMedias);
                this.selectedMedias.splice(0);
            }
            deletedMedias = deletedMedias.map(string => Number(string));
            axios.delete("/api/media/delete/", { data: deletedMedias }).then(response => {
                this.GetMedias();
            }).catch(error => {
                console.log(error.response);
            });
        },

        EditMedia: function(event, id) {
            this.selectedMedia = id;
            this.$nextTick(function () {
                this.$refs.media.Open();
            });
            
        },

        UpdateMedia: function(mediaId) {
            this.isMediasLoad = false;
            axios.get(`/api/media/update/${mediaId}`).then(response => {
                this.medias = response.data;
                this.isMediasLoad = true;
            }).catch(error => {
                console.log(error.response);
            });
        }
    }
}
</script>

<style>
    
body {
    background-color: var(--white);
}

.navbar {
    background-color: var(--black);
}

.navbar-brand img {
    margin-right:10px;
    width: 40px;
}

.dropdown-divider {
    margin: 0px;
}

main {
    padding: 100px 0px 50px !important;
}

.table>:not(caption)>*>* {
    padding: 1rem 0.5rem;
}

.table {
    border-collapse: separate;
    border-spacing: 0 5px;
}

.table tbody > tr {
    background-color: #fff;
    border-radius: 5px;
    height: 74px;
    max-height: 74px;
}

.table tbody > tr > td {
    vertical-align: middle;
}

.table thead {
    font-size: 11px;
    color: var(--gray);
}

.table thead .table-col-chekbox, .table tbody .table-col-chekbox {
    width: 80px;
    min-width: 60px;
    text-align: center;
    position: relative;
}

.table tbody .table-name {
    min-width: 40%;
    text-align: left;
    font-weight: bold;
}

.table tbody .table-time {
    min-width: 40%;
    text-align: left;
    font-weight:lighter;
}

.table tbody .td-action {
    text-align: center;
    width: 60px;
}

.table tbody .table-action {
    text-align: center;
    position: relative;
    display: inline-block;
    vertical-align: middle;
}

input[type="checkbox"] + label {
    justify-content: center;
}
</style>