<template>
<Modal :title="title" size="low" ref="modal">
    <div>
        <h6>Media</h6>
        <hr class="dropdown-divider">

        <div>
            <img :src="media.url" />
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Name:</label>
                <input type="text" class="form-control" id="title" v-model="media.title">
            </div>
        </div>
    </div>

    <template v-slot:footer>
        <button type="button" class="btn btn-primary" @click.prevent="SaveMedia">Save media</button>
        <button type="button" class="btn btn-secondary" @click.prevent="this.$refs.modal.Open()">Cancel</button>
    </template>
</Modal>
</template>

<script>
import Modal from "./Modal.vue";
import Loader from "./Loader.vue";

export default {
    name: "Modal.Media",
    components: { Modal, Loader },
    props: ["title", "media", "callback", "isMediasLoad"],
    data() {
        return {
            isLoading: false
        }
    },

    computed: {
        type: {
            get() {
                switch(this.typeFile) {
                    case "image":
                        return "image/png, image/jpeg";
                    
                    case "video":
                        return "video/mp4, image/avi, image/mpeg, image/x-msvideo";

                    default :
                        return "";
                }
            }
        }
    },

    mounted() {
        console.log(this.media);
    },

    methods: {
        Open: function() {
            this.$refs.modal.Open();
        },

        SaveMedia: function(media) {
            this.isLoading = true;
            if(this.callback && typeof this.callback == "function") this.callback(media.id);
        }
    }
};
</script>

<style scoped>
.items {
    display: flex;
    flex-wrap: wrap;
}

.items .item {
    flex: 1 1 120px;
    min-width:120px;
    max-width: 160px;
    margin: 0 10px 10px 0;
    transition: all 0.2s ease-in-out;
    border: 2px solid transparent;
}

.items .item.selected {
    border-color: var(--accent-color-light);
}

.items .item:hover {
    transform: scale(1.05);
}

.items .item .preview {
    min-width:120px;
    height:120px;
    overflow: hidden;
}

.items .item .preview img, .items .item .preview video {
    width: 100%;
}

.items .item .title {
    word-wrap:break-word;
}
</style>
