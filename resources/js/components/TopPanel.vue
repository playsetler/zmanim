<template>
    <div class="col editor-panel">
        <button class="add editor-panel-item" @click.prevent.stop="$emit('showAddMedia')" @mousedown.stop>
            Insert
            <i class="bi bi-plus-circle"></i>
        </button>

        <button class="edit editor-panel-item" @click.prevent.stop="$emit('showEditMedia')" @mousedown.stop :disabled="selectedMedia == null">
            <i class="bi bi-pencil-square"></i>
        </button>

        <button class="delete editor-panel-item"
            @click.prevent.stop="RemoveMedia(this.selectedMedia)"
            @mousedown.stop
            :disabled="selectedMedia == null">
            <i class="bi bi-trash"></i>
        </button>
        <a :href="'/preview/' + this.$route.params.id" target="_blank" class="btn btn-primary" id="preview"><i class="bi bi-display"></i> Preview</a>
    </div>
</template>

<script>
export default {
    name: "TopPanel",
    inject: ["selectedMedia", "RemoveMedia"],
    emits: ["showAddMedia", "showEditMedia"]
}
</script>

<style scoped>
/* -------------------editor-panel-------------------- */

.editor-panel-item {
    padding: 7px 10px;
    border:none;
    background-color: transparent;
    cursor: pointer;
    transition: all 0.1s ease-out;
    transform: scale(1);
}

.editor-panel-item i:before {
    font-size: 20px;
    color: var(--gray);
    position: relative;
    top: 4px;
}

.editor-panel-item:hover:not(:disabled) i:before {
    color: var(--accent-color-regular);
}

.editor-panel-item:disabled i:before {
    color: var(--gray-light);
}

.editor-panel-item:active:not(:disabled) {
    transform: scale(0.95);
    color: var(--accent-color-regular);
}

.editor-panel-item.add, .editor-panel-item.add i:before {
    color: var(--accent-color-regular);
}

/* -------------------editor-panel-------------------- */
</style>