<template>
    <div>
        <input class="form-check-input" type="checkbox" :id="`${id}`" :checked="checked" :value="value" @change.prevent="$emit('change', $event.target)">
        <label class="form-check-label" :for="`${id}`"></label>
    </div>
</template>

<script>

export default {
    name: "Checkbox",
    emits: ['change'],
    props: ['checked', 'id', 'value'],
    mounted() {
    },
    methods: {
        
    }
}
</script>

<style>

</style>