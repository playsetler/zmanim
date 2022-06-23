<template>
<div class="container-md">
<Header />
    <main>
        <div class="row g-0 editor align-items-center">
            <div class="row g-0 editor-header">
                <div class="col align-self-center">
                    <h5>Layout: <span class="layout-name">{{ layout.name }}</span></h5>
                </div>
                <TopPanel @show-add-media="this.$refs.AddMediaMenu.Open()" @show-edit-media="this.$refs.EditMediaMenu.Open()" />
            </div>
            
            <div class="editor-container" ref="editorContainer">

                <OutputMedia
                    title="Select media"
                    ref="outputMedia" />

                <AddMediaMenu :isLayoutLoad="isLayoutLoad" ref="AddMediaMenu" />

                <EditMediaMenu :isLayoutLoad="isLayoutLoad" ref="EditMediaMenu" />

                <LayoutWindow
                    v-if="isLayoutLoad"
                    :media="layout.media"
                    :key="layout.width"
                    ref="layoutWindow" />

                <Loader v-else />

                <EditLayout
                    :isLayoutLoad="isLayoutLoad"
                    @save-layout="SaveLayout"
                    @select-orientation="SetLayoutWindowSize" />
            </div>
        </div>
    </main>
</div>
</template>

<script>
import { computed } from 'vue';
import Header from "../components/Header.vue";
import Loader from "../components/Loader.vue";
import LayoutWindow from "../components/LayoutWindow.vue";
import TopPanel from "../components/TopPanel.vue";
import EditLayout from "../components/EditLayout.vue";
import EditMediaMenu from "../components/EditMediaMenu.vue";
import AddMediaMenu from "../components/AddMediaMenu.vue";
import OutputMedia from "../components/Modal.OutputMedia.vue";
export default {
    name: "Layout",
    components: { Header, Loader, LayoutWindow, TopPanel, EditLayout, EditMediaMenu, AddMediaMenu, OutputMedia },
    data() {
        return {
            layout: {
                id: this.$route.params.id ?? null,
                name: "",
                backgroundType: "",
                backgroundColor: "",
                backgroundImage: "",
                backgroundSize: "",
                orientation: "landscape",
                media:[],
                width: 0,
                height: 0
            },
            isLayoutLoad: false,
            selectedMedia: null
        }
    },

    provide() {
        return {
            layout: this.layout,
            selectedMedia: computed(() => this.selectedMedia),
            SelectMedia: this.SelectMedia,
            RemoveMedia: this.RemoveMedia,
            AddMedia: this.AddMedia
        }
    },

    mounted() {
        window.addEventListener('resize', () => {
            this.SetLayoutWindowSize();
        });

        if(this.layout.id != null) {
            this.GetLayout();
        } else {
            this.isLayoutLoad = true;
        }

        this.SetLayoutWindowSize();
    },

    methods: {
        SetLayoutWindowSize: function() {
            if(this.layout.orientation == "landscape") {
                this.layout.width = this.$refs.editorContainer.clientWidth * 80 / 100;
                this.layout.height = this.layout.width / (16 / 9);
            } else if(this.layout.orientation == "portrait") {
                this.layout.width = this.$refs.editorContainer.clientWidth * 45 / 100;
                this.layout.height = this.layout.width * (16 / 9);
            }
        },

        GetLayout: function() {
            this.isLayoutLoad = false;
            axios.get('/api/layouts/' + this.layout.id).then(response => {
                this.layout = Object.assign(this.layout, response.data);
                this.isLayoutLoad = true;
                this.SetLayoutWindowSize();
            }).catch(error => {
                console.log(error.response);
            });
        },

        SaveLayout: function() {
            if(this.layout.id == null) {
                this.isLayoutLoad = false;
                axios.post('/api/layouts/create/', {
                    name: this.layout.name,
                    orientation: this.layout.orientation,
                    backgroundType: this.layout.backgroundType,
                    backgroundColor: this.layout.backgroundColor,
                    backgroundImage: this.layout.backgroundImage,
                    backgroundSize: this.layout.backgroundSize,
                    media: this.layout.media
                }).then(response => {
                    this.$router.replace({name: "Edit", params: {id: response.data.id}});
                    this.isLayoutLoad = true;
                }).catch(error => {
                    console.log(error.response);
                });
            } else {
                this.isLayoutLoad = false;
                axios.post(`/api/layouts/update/${this.layout.id}`, {
                    name: this.layout.name,
                    orientation: this.layout.orientation,
                    backgroundType: this.layout.backgroundType,
                    backgroundColor: this.layout.backgroundColor,
                    backgroundImage: this.layout.backgroundImage,
                    backgroundSize: this.layout.backgroundSize,
                    media: this.layout.media
                },{
                    headers: {
                        'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].getAttribute("content")
                    }
                }).then(response => {
                    this.isLayoutLoad = true;
                }).catch(error => {
                    console.log(error.response);
                });
            }
        },

        RemoveLayout: function() {
        },

        SelectOrientation: function(value) {
            this.layout.orientation = value;
            this.SetLayoutWindowSize();
        },

        SelectMedia: function(mediaIndex) {
            this.selectedMedia = mediaIndex;
        },

        AddMedia: function(media) {
            this.layout.media.push(media);
        },

        RemoveMedia: function(mediaIndex = null) {
            this.selectedMedia = null;
            if(mediaIndex != null) this.layout.media.splice(mediaIndex, 1);
        }
    }
}
</script>

<style>
main, .container-md, .editor, .editor-container {
    width: 100%;
    height: 100%;
}

.editor-header {
    background-color: #fff;
    padding: 15px 35px;
    height:unset;
}

.editor-container {
    position: relative;
    display: flex;
    justify-content: center;
    overflow: hidden;
}

.menu-open-button {
    position: absolute;
    top: 30px;
    padding: 6px 10px;
    border: 3px solid #fff;
    background-color: #fff;
    border-radius:50%;
    color: var(--gray);
    z-index: 100;
}

.editor-menu {
    position: absolute;
    top:0;
    width: 300px;
    height: 100%;
    background-color: #fff;
    padding: 35px;
    transition: all 0.3s;
    z-index:100;
}

.slide-fade-enter-active {
  transition: all 0.4s cubic-bezier(0, 0.6, 0, 0.9);
}

.slide-fade-leave-active {
  transition: all 0.4s cubic-bezier(0, 0.6, 0, 0.9);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}
</style>