<template>
<div :class="[ 'modal', 'fade', { show: isVisible }]" :style="{ display: isVisible ? 'block' : 'none' }" id="staticBackdrop" tabindex="-1">
    <div :class="['modal-dialog', 'modal-dialog-scrollable', getSize]">
        <div class="modal-content" ref="content" @blur.prevent="isVisible = !isVisible">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ title }}</h5>
                <button type="button" class="btn-close" aria-label="Close" @click.prevent="Open"></button>
            </div>
            <div class="modal-body">
                <slot></slot>
            </div>
            <div class="modal-footer">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</div>
</template>

<script>


export default {
    name: "Modal",
    props: ["title", "size"],
    data() {
        return {
            isVisible: false
        }
    },
    computed: {
        getSize() {
            switch(this.size) {
                case "large":
                    return "modal-xl";
                    break;

                case "normal":
                    return "modal-lg";
                    break;

                case "small":
                    return "modal-sm";
                    break;

                default:
                    return "modal-lg";
                    break;
            }
        }
    },
    methods: {
        Open: function() {
            this.isVisible = !this.isVisible;
        }
    }
};
</script>

<style scoped>
.modal {
    background-color: rgba(0, 0, 0, 0.7);
}
</style>
