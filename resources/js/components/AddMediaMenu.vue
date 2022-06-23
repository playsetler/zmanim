<template>
    <OutputMedia
        title="Select image"
        typeFile="image"
        :callback="CreateImage"
        ref="createImage" />
    <OutputMedia
        title="Select video"
        typeFile="video"
        :callback="CreateVideo"
        ref="createVideo" />
    <div :class="[ 'editor-menu', 'editor-media', { open: isOpen } ]">
        
        <h6>Media</h6>
        <hr class="dropdown-divider">
        <a href="#" class="media-image editor-media-item" @click.prevent="this.$refs.createImage.Open">
            <i class="bi bi-image"></i>
        </a>
        <a href="#" class="media-video editor-media-item" @click.prevent="this.$refs.createVideo.Open">
            <i class="bi bi-film"></i>
        </a>
        <a href="#" class="media-text editor-media-item" @click.prevent="CreateText">
            <i class="bi bi-fonts"></i>
        </a>
        <a href="#" class="media-ticker editor-media-item" @click.prevent="CreateTicker">
            <i class="bi bi-textarea-t"></i>
        </a>
        <a href="#" class="media-webpage editor-media-item">
            <i class="bi bi-globe"></i>
        </a>
        <a href="#" class="menu-open-button" @click.prevent="Open()">
            <i class="bi bi-arrow-left-right"></i>
        </a>
    </div>
</template>

<script>
import OutputMedia from "./Modal.OutputMedia.vue";
export default {
    name: "AddMedia",
    components: { OutputMedia },
    inject: ["layout"],
    props: ["isLayoutLoad"],
    data() {
        return {
            isOpen: false
        }
    },
    methods: {
        Open: function() {
            this.isOpen = !this.isOpen;
        },

        GetMediaTemplate: function() {
            return {
                minWidth: 150,
                minHeight: 100,
                percentWidth: 0,
                percentHeight: 0,
                percentLeft: 0,
                percentTop: 0,
                top: 0,
                left: 0,
                width: null,
                height: null,
                zIndex: 0
            }
        },

        CreateId: function() {
            return Math.floor(100000000 + Math.random() * 900000000);
        },

        CreateImage: function(media) {
            this.layout.media.push(
                Object.assign(this.GetMediaTemplate(), {
                id: this.CreateId(),
                type: "image",
                src: media.url
            }));
            this.isOpen = false;
        },

        CreateVideo: function(media) {
            this.layout.media.push(Object.assign(this.GetMediaTemplate(), {
                id: this.CreateId(),
                type: "video",
                src: media.url,
                duration: 5,
                autoplay: true,
                loop: true
            }));
            this.isOpen = false;
        },

        CreateTicker: function() {
            this.layout.media.push(Object.assign(this.GetMediaTemplate(), {
                id: this.CreateId(),
                type: "ticker",
                text: "Lorem Ipsum",
                duration: 5,
                fontSize: 16,
                color: "#000000"
            }));
            this.isOpen = false;
        },

        CreateText: function() {
            this.layout.media.push(Object.assign(this.GetMediaTemplate(), {
                id: this.CreateId(),
                type: "text",
                text: "Lorem Ipsum",
                fontSize: 16,
                color: "#000000",
                alignment: "left"
            }));
            this.isOpen = false;
        },

        CreateWebPage: function() {
            this.layout.media.push(Object.assign(this.GetMediaTemplate(), {
                id: this.CreateId(),
                type: "web",
            }));
            this.isOpen = false;
        }
    }
}
</script>

<style scoped>
/* -------------------editor-media-------------------- */

.editor-menu {
    width: auto;
}

.editor-media {
    left:0;
    display: flex;
    flex-direction: column;
    transform: translateX(-100%);
}

.editor-media.open {
    transform: translateX(0%);
}

.editor-media .menu-open-button {
    right: -20px;
}

.editor-media-item {
    padding:30px 35px;
}

.editor-media-item:hover {
    background-color: var(--gray-light);
}

.editor-media-item i:before {
    font-size:36px;
}

/* -------------------editor-media-------------------- */
</style>