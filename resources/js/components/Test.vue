<template>
    <div>
        <slot :works="parentWorks"></slot>
        <button @click.prevent="add" :disabled="selected == null">Добавить</button>
        <button @click.prevent="remove">Удалить</button>
    </div>
</template>

<script>

export default {
    name: "Test",
    inject: ['works', 'selected'],
    data() {
        return {
            parentWorks: this.works
        }
    },
    mounted() {
        //this.parentName = '321';
        console.log(this.parentWorks);
    },

    methods: {
        add: function() {
            this.parentWorks.push("Новая задача");
        },

        remove: function() {
            this.parentWorks.pop();
        }
    }
}
</script>

<style scoped>

</style>