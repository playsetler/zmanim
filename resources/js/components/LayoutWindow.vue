<template>
    <div ref="editorLayout"
    :class="[ 'editor-layout', layout.orientation ]"
    :style="{
        backgroundColor: layout.backgroundColor,
        backgroundImage: ((layout.backgroundImage != '') ? 'url(' + layout.backgroundImage + ')' : ''),
        backgroundSize: layout.backgroundSize,
        width: layout.width + 'px',
        height: layout.height + 'px'
    }">
        <Media
            v-for="(item, index) in media"
            :key="item.id"
            :index="index"
            :item="item"
            :parentRect="getParentRect"
            :ref="(el) => { this.refs[index] = el }">
        </Media>
    </div>
</template>

<script>
import Media from "../components/Media.vue";
export default {
    name: "LayoutWindow",
    components: { Media },
    inject: ["layout", "RemoveMedia", "selectedMedia"],
    props: ["media"],
    data() {
        return {
            refs: [],
            style: {
                
            }
        }
    },

    mounted() {
        if(this.media.length > 0) {
            document.addEventListener('keydown', (event) => {
                if(this.selectedMedia == null) return false;
                event.preventDefault();
                switch(event.key.toLowerCase()) {
                    case "delete":
                        this.RemoveMedia(this.selectedMedia)
                        break;

                    case "arrowup":
                        this.layout.media[this.selectedMedia].top -= 1;
                        break;

                    case "arrowdown":
                        this.layout.media[this.selectedMedia].top += 1;
                        break;

                    case "arrowleft":
                        this.layout.media[this.selectedMedia].left -= 1;
                        break;

                    case "arrowright":
                        this.layout.media[this.selectedMedia].left += 1;
                        break;

                    default:
                        break;
                }
            });
        }
    },

    methods: {
        getParentRect: function() {
            let rect = this.$refs.editorLayout.getBoundingClientRect();
            return { left: rect.left + window.pageXOffset, top: rect.top + window.pageYOffset, width: rect.width, height: rect.height }
        }
    }
}
</script>

<style scoped>
/* -------------------editor-layout-------------------- */

.editor-layout {
    flex: 0 0 50%;
    background-color: var(--accent-color-dark);
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
}

.editor-layout.landscape {
    flex: 0 0 80%;
}

.editor-layout.portrait {
    flex: 0 0 45%;
}

/* -------------------editor-layout-------------------- */
</style>