<template>
    <FileUpload
        title="Upload background image"
        type-file="image"
        :callback="ChangeBackgroundImage"
        ref="fileUpload" />

    <div v-bind="$attrs" :class="[ 'editor-menu', 'editor-context', { open: isOpen } ]">
        <h6>Layout Settings</h6>
        <hr class="dropdown-divider">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" id="layout-name" v-model="layout.name">
        </div>
        <div class="mb-3">
            <label for="orientation" class="form-label">Orientation</label>
            <select class="form-select" id="layout-orientation" v-model="layout.orientation" @change.prevent="$emit('selectOrientation', $event.target.value)">
                <option disabled value="none">Choose an option</option>
                <option value="landscape">Landscape</option>
                <option value="portrait">Portrait</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="background" class="form-label">Background Type</label>
            <select class="form-select" id="layout-background" v-model="layout.backgroundType">
                <option disabled value="none">Open this select menu</option>
                <option value="color">Color</option>
                <option value="image">Image</option>
            </select>
        </div>
        <div class="mb-3" v-if="layout.backgroundType == 'image'">
            <label for="background-image" class="form-label">Select file</label>
            <div class="background-preview">
                <img v-if="layout.backgroundImage != ''" :src="layout.backgroundImage" class="img-fluid" />
            </div>
            
            <button @click.prevent="this.$refs.fileUpload.Open">Upload New Image</button>

            <div class="mb-3">
                <label for="orientation" class="form-label">Background Size</label>
                <select class="form-select" v-model="layout.backgroundSize">
                    <option disabled value="none">Choose an option</option>
                    <option value="cover">Cover</option>
                    <option value="contain">Contain</option>
                </select>
            </div>
        </div>
        <div class="mb-3" v-else-if="layout.backgroundType == 'color'">
            <label for="background-color" class="form-label">Color picker</label>
            <input type="color" class="form-control form-control-color" id="layout-background-color" title="Choose your color" v-model="layout.backgroundColor">
        </div>
        <div class="row g-0">
            <div class="col">
                <button class="btn btn-primary mb-3" @click.prevent="$emit('saveLayout')" :disabled="!isLayoutLoad">{{ layout.id != null ? 'Save' : 'Create' }}</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary mb-3" id="cancel" @click.prevent="Cancel">Cancel</button>
            </div>
        </div>
        <a href="#" class="menu-open-button" @click.prevent="Open()">
            <i class="bi bi-arrow-left-right"></i>
        </a>
    </div>
</template>

<script>
import FileUpload from "./Modal.FileUpload.vue";
export default {
    name: "EditLayout",
    components: { FileUpload },
    props: ["isLayoutLoad"],
    inject: ["layout"],
    emits: ["saveLayout", "selectOrientation"],
    data() {
        return {
            isOpen: false
        }
    },
    methods: {
        Open: function() {
            this.isOpen = !this.isOpen;
        },

        ChangeBackgroundImage: function(newPathImage) {
            this.layout.backgroundImage = newPathImage;
        },

        Cancel: function() {
            this.$router.push({name: "Layouts"});
        }


    }
}
</script>

<style scoped>
/* -------------------editor-context-------------------- */

.editor-context {
    transform: translateX(100%);
    right:0;
}

.editor-context.open {
    transform: translateX(0%);
}

.editor-context .btn {
    width:100%;
}

.editor-context .menu-open-button {
    left: -20px;
}

.editor-context .background-preview {
    height: 180px;
    overflow: hidden;
}

/* -------------------editor-context-------------------- */
</style>