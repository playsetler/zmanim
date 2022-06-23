<template>
    <div :class="[ 'editor-menu', 'editor-media', { open: isOpen } ]" tabindex="1" ref="editorMedia" @mousedown.stop>
        <h6>Media</h6>
        <hr class="dropdown-divider">

        <div v-if="selectedMedia != null" class="row mt-3">
            <div class="col-md-6">
                <label for="top" class="form-label">Top:</label>
                <input type="number" class="form-control" id="top" v-model="layout.media[selectedMedia].top">
            </div>
            
            <div class="col-md-6">
                <label for="left" class="form-label">Left:</label>
                <input type="number" class="form-control" id="left" v-model="layout.media[selectedMedia].left">
            </div>
        </div>

        <div v-if="selectedMedia != null" class="row mt-3">
            <div class="col-md-6">
                <label for="width" class="form-label">Width:</label>
                <input type="number" class="form-control" id="width" v-model="layout.media[selectedMedia].width">
            </div>
            
            <div class="col-md-6">
                <label for="height" class="form-label">Height:</label>
                <input type="number" class="form-control" id="height" v-model="layout.media[selectedMedia].height">
            </div>
        </div>
        
        <div class="row mt-3" v-if="selectedMedia != null && (layout.media[selectedMedia].type == 'text' || layout.media[selectedMedia].type == 'ticker')">
            <div class="col-12">
                <label for="text" class="form-label">Text:</label>
                <input type="text" class="form-control" id="text" v-model="layout.media[selectedMedia].text">
            </div>

            <div class="col-12 mt-3">
                <label for="width" class="form-label">Font size:</label>
                <input type="number" class="form-control" id="fontSize" v-model="layout.media[selectedMedia].fontSize">
            </div>
            
            <div class="col-12 mt-3">
                <label for="color" class="form-label">Color:</label>
                <input type="color" class="form-control form-control-color" id="color" title="Choose text color" v-model="layout.media[selectedMedia].color">
            </div>
        </div>

        <div class="col-12 mt-3" v-if="selectedMedia != null && layout.media[selectedMedia].type == 'ticker'">
            <label for="duration" class="form-label">Duration:</label>
            <input type="number" class="form-control" id="duration" min="1" max="30" v-model="layout.media[selectedMedia].duration">
        </div>

        <div class="mt-3" v-if="selectedMedia != null && layout.media[selectedMedia].type == 'text'">
            <label class="form-label">Alignment:</label>
            <div class="col-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="alignmentLeft" value="left" v-model="layout.media[selectedMedia].alignment">
                    <label class="form-check-label" for="alignmentLeft">left</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="alignmentCenter" value="center" v-model="layout.media[selectedMedia].alignment">
                    <label class="form-check-label" for="alignmentCenter">center</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="alignmentRight" value="right" v-model="layout.media[selectedMedia].alignment">
                    <label class="form-check-label" for="alignmentRight">right</label>
                </div>
            </div>
        </div>

        <div v-if="selectedMedia != null && layout.media[selectedMedia].type == 'video'">
            <div class="mt-3">
                <input class="form-check-input" type="checkbox" value="autoplay" id="autoplay" v-model="layout.media[selectedMedia].autoplay">
                <label class="form-check-label" for="autoplay">Autoplay</label>
            </div>

            <div class="mt-3">
                <input class="form-check-input" type="checkbox" value="loop" id="loop" v-model="layout.media[selectedMedia].loop">
                <label class="form-check-label" for="loop">Loop</label>
            </div>
        </div>

        <div v-if="selectedMedia != null && (layout.media[selectedMedia].type == 'image' || layout.media[selectedMedia].type == 'video')">
            <div class="mt-3">
                <input class="form-check-input" type="checkbox" value="lockAspect" id="lockAspect" v-model="layout.media[selectedMedia].lockAspect">
                <label class="form-check-label" for="lockAspect">Lock Aspect Ratio</label>
            </div>
        </div>
        
        <a href="#" class="menu-open-button" @click.prevent="Open()">
            <i class="bi bi-arrow-left-right"></i>
        </a>
    </div>
</template>

<script>
import Checkbox from "../components/Checkbox.vue";
export default {
    name: "EditMedia",
    components: { Checkbox },
    inject: ["layout", "selectedMedia"],
    props: ["isLayoutLoad"],

    data() {
        return {
            isOpen: false,
            lockAspect: true
        }
    },

    mounted() {
        
    },

    watch: {
        isLayoutLoad(newValue) {
            if(newValue) {
                this.layout.media.forEach((media, index) => {
                    if(this.layout.media[index].type == "image" || this.layout.media[index].type == "video")
                        this.layout.media[index]['lockAspect'] = true;
                });
            }
            
        },

        lockAspect(newlockAspect) {
            this.layout.media[this.selectedMedia].lockAspect = newlockAspect;
        },

        selectedMedia(newSelectedMedia) {
            if(newSelectedMedia != null && (this.layout.media[this.selectedMedia].type == "image" || this.layout.media[this.selectedMedia].type == "video"))
                    this.layout.media[this.selectedMedia].lockAspect = this.lockAspect;
            if(newSelectedMedia == null) this.isOpen = false;
        }
    },
    
    methods: {
        Open: function() {
            this.isOpen = !this.isOpen;
        }
    }
}
</script>

<style scoped>
/* -------------------editor-media-------------------- */

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