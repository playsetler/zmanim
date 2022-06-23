<template>
    <Modal :title="title" :callback="callback">
        <template v-slot:trigger="{ open }">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">75%</div>
            </div>
        </template>
    </Modal>
</template>

<script>
import Modal from './Modal.vue';

export default {
    name: "FileUpload",
    components: { Modal },
    props: ["title", "callback"],
    mounted() {
        console.log(this.$attrs);
    },
    methods: {
        Open: function() {
            this.open();
        }
    }
}
</script>

<style scoped>

</style>