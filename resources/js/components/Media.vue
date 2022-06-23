<template>
    <VueDragResize
        :tabindex="index"
        :isActive="index == selectedMedia"
        :parentLimitation="true"
        :contentClass="'media ' + item.type"
        :w="layout.media[index].width ?? layout.media[index].minWidth"
        :h="layout.media[index].height ?? layout.media[index].minHeight"
        :x="layout.media[index].left"
        :y="layout.media[index].top"
        :aspectRatio="layout.media[index].lockAspect"
        :zIndex="layout.media[index].zIndex"
        @resizing="Resize"
        @dragging="Resize"
        @clicked="SelectMedia(index)"
        @blur="SelectMedia(null)"
        ref="media">

        <img v-if="item.type == 'image'" :src="item.src" />

        <video v-if="item.type == 'video'" :src="item.src" :autoplay="item.autoplay" :loop="item.loop" muted></video>

        <p v-if="item.type == 'text'" :style="{ color: item.color, fontSize: item.fontSize + 'px', textAlign: item.alignment }">{{ item.text }}</p>

        <p v-if="item.type == 'ticker'" :style="{ animationDuration: item.duration + 's', color: item.color, fontSize: item.fontSize + 'px' }">{{ item.text }}</p>

    </VueDragResize>
</template>

<script>
import VueDragResize from 'vue-drag-resize';
export default {
    name: "Media",
    components: { VueDragResize },
    inject: ["layout", "SelectMedia", "selectedMedia"],
    props: ["index", "item", "parentRect"],
    data() {
        return {
            isActive: false
        }
    },

    methods: {
        Resize: function(newRect) {
            let parentRect = this.parentRect();
            this.layout.media[this.index].left = newRect.left;
            this.layout.media[this.index].top = newRect.top;

            this.layout.media[this.index].width = newRect.width;
            this.layout.media[this.index].height = newRect.height;

            this.layout.media[this.index].percentWidth = newRect.width * 100 / parentRect.width;
            this.layout.media[this.index].percentHeight = newRect.height * 100 / parentRect.height;
            this.layout.media[this.index].percentLeft = newRect.left * 100 / parentRect.width;
            this.layout.media[this.index].percentTop = newRect.top * 100 / parentRect.height;
        },

        SelectCurrentMedia: function(ev) {
            this.$nextTick(() => {
                if(ev) this.$refs.media.focus();
            });
        }
    }
}
</script>

<style scoped>
.media {
    position: absolute;
    border-style: dashed;
    border-width: 4px;
    border-color: transparent;
    z-index: 10;
}

.media:hover {
    border-color: var(--accent-color-regular);
}

.media.active {
    border-color: var(--accent-color-light);
}

.media img, .media video {
    width: 100%;
    height: 100%;
    background-color: #000;
}

.media.text, .media.ticker {
    padding: 0px 10px;
}

.media.ticker {
    overflow: hidden;
    margin: 0 auto;
    padding: 0;
}

.media.ticker p {
    text-align:center;
    animation-name: ticker;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    padding-left: 100%;
    white-space: nowrap;
    display: inline-block;
}

@keyframes ticker {
  0%{
    transform: translate(0, 0);
  }
  
  100%{
    transform: translate(-100%, 0);
  }
}

.resize {
    position: absolute;
    display: none;
    cursor: w-resize;
    width:15px;
    height: 15px;
    border:1px solid #000;
    background-color: #fff;
    pointer-events: all!important;
    z-index: 20;
}

.media.active .resize {
    display: block;
}

.resize.e {
    inset: 50% -7px auto auto;
    transform: translateY(-50%);
    cursor: e-resize;
}

.resize.w {
    inset: 50% auto auto -7px;
    transform: translateY(-50%);
    cursor: w-resize;
}

.resize.n {
    inset: -7px auto auto 50%;
    transform: translateX(-50%);
    cursor: n-resize;
}

.resize.s {
    inset: auto auto -7px 50%;
    transform: translateX(-50%);
    cursor: s-resize;
}

.resize.ne {
    inset: -7px -7px auto auto;
    transform: none;
    cursor: ne-resize;
}

.resize.nw {
    inset: -7px auto auto -7px;
    transform: none;
    cursor: nw-resize;
}

.resize.se {
    inset: auto -7px -7px auto;
    transform: none;
    cursor: se-resize;
}

.resize.sw {
    inset: auto auto -7px -7px;
    transform: none;
    cursor: sw-resize;
}
</style>