<template>
<Modal :title="title" ref="modal">
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :aria-valuenow="uploadProgress" aria-valuemin="0" aria-valuemax="100" :style="{ width: uploadProgress + '%' }">{{ uploadProgress }}%</div>
    </div>
    <div class="mb-3">
        <label for="background-image" class="form-label">Select file</label>
        <input class="form-control" type="file" :name="typeFile" id="layout-background-image" :accept="type" @change="FileInputChange" ref="input">
    </div>
</Modal>
</template>

<script>
import Modal from "./Modal.vue";

export default {
    name: "FileUpload",
    components: { Modal },
    props: ["title", "typeFile", "callback"],
    data() {
        return {
            uploadProgress: 0
        }
    },
    computed: {
        type: {
            get() {
                switch(this.typeFile) {
                    case "image":
                        return "image/png, image/jpeg";
                    
                    case "video":
                        return "video/mp4, video/mpeg, video/avi, video/ogg, video/x-msvideo, video/x-msvideo, video/x-flv, video/webm";

                    case "audio":
                        return "audio/mpeg, audio/aac, audio/mp4, audio/ogg";

                    default :
                        return "";
                }
            }
        }
    },
    mounted() {
    },
    methods: {
        Open: function() {
            this.$refs.modal.Open();
        },

        Reset: function() {
            this.$refs.input.value = "";
            this.uploadProgress = 0;
        },

        FileInputChange: async function(event) {
            let form = new FormData();
            form.append("mediaType", this.typeFile);
            form.append("file", event.target.files[0]);
            form.append("_token", document.getElementsByTagName('meta')['csrf-token'].getAttribute("content"));
            await axios.post('/api/upload/', form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: (itemUpload) => {
                    this.uploadProgress = parseInt(Math.round((itemUpload.loaded / itemUpload.total) * 100));
                }
            }).then(response => {console.log(response);
                if(this.callback && typeof this.callback == "function") this.callback(response.data.url);
                this.Reset();
                this.Open();
            }).catch(error => {
                console.log(error.response);
            });
        }
    }
};
</script>

<style scoped>

</style>
