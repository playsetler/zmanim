<template>
<Modal :title="title" size="large" ref="modal">
    <FileUpload
        title="Upload"
        :type-file="typeFile"
        :callback="GetMedia"
        ref="fileUpload" />
    <button @click.prevent="this.$refs.fileUpload.Open">Upload</button>
    <div v-if="isMediaLoad" class="items">
        <div :class="['item', { selected: selectedIndex == mediaIndex }]" v-for="(mediaItem, mediaIndex) in media" :key="mediaIndex" @click.prevent="selectedIndex = mediaIndex">
            <div class="preview">
                <img v-if="mediaItem.type == 'image'" :src="mediaItem.url" :alt="mediaItem.title" class="img-fluid" />

                <video v-if="mediaItem.type == 'video'" :src="mediaItem.url" :alt="mediaItem.title"></video>
            </div>
            <span class="title">{{ mediaItem.title }}</span>
        </div>
    </div>

    <Loader v-else />

    <template v-slot:footer>
        <button type="button" class="btn btn-primary" :disabled="selectedIndex == null" @click.prevent="SelectMedia(media[selectedIndex])">Insert media</button>
    </template>
</Modal>
</template>

<script>
import Modal from "./Modal.vue";
import Loader from "./Loader.vue";
import FileUpload from "./Modal.FileUpload.vue";

export default {
    name: "OutputMedia",
    components: { Modal, Loader, FileUpload },
    props: ["title", "typeFile", "callback"],
    inject: ["AddMedia"],
    data() {
        return {
            media: [],
            isMediaLoad: false,
            isButtonDisabled: false,
            selectedIndex: null
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
        
    },

    methods: {
        GetMedia: async function() {
            this.isMediaLoad = false;
            await axios.get(`/api/media/${this.typeFile}`).then(response => {
                this.media = response.data;
                this.isMediaLoad = true;
            }).catch(error => {
                console.log(error.response);
            });
        },

        Open: function() {
            this.$refs.modal.Open();
            this.GetMedia();
        },

        SelectMedia: function(media) {
            if(this.callback && typeof this.callback == "function") this.callback(media);
            this.$refs.modal.Open();
        },
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
