<template>
  <div>
    <vueper-slides
      class="vueperslides--1"
      ref="vueperslides1"
      :touchable="false"
      fade="fade"
      :arrows="false"
      :autoplay="false"
      :bullets="false"
      @slide="$refs.vueperslides2 &amp;&amp; $refs.vueperslides2.goToSlide($event.currentSlide.index, { emit: false })"
      fixed-height="400px"
    >
      <vueper-slide
        v-for="(slide, i) in slider"
        :key="i"
        :image="slide"
        style="max-height: 400px"
      >
      </vueper-slide> </vueper-slides
    ><br />
    <vueper-slides
      class="no-shadow vueperslides--2"
      ref="vueperslides2"
      @slide="$refs.vueperslides1 &amp;&amp; $refs.vueperslides1.goToSlide($event.currentSlide.index, { emit: false })"
      :visible-slides="slider.length"
      fixed-height="75px"
      :bullets="false"
      :touchable="false"
      :gap="2.5"
      :arrows="false"
    >
      <vueper-slide
        v-for="(slide, i) in slider"
        :key="i"
        :image="slide"
        @click.native="$refs.vueperslides2 &amp;&amp; $refs.vueperslides2.goToSlide(i)"
      ></vueper-slide>
    </vueper-slides>
  </div>
</template>
   <style >
.vueperslides--fade .vueperslide {
  max-height: 550px;
  max-width: 550px;
  margin: auto;
}
.vueperslides--2 .vueperslide {
  box-sizing: border-box;
  border: 1px solid #fff;
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
  opacity: 0.7;
  max-width: 100px;
}
.vueperslides--2 .vueperslide--active {
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
  opacity: 1;
  border-color: #000;
}

.vueperslides:not(.no-shadow):not(.vueperslides--3d)
  .vueperslides__parallax-wrapper:after,
.vueperslides:not(.no-shadow):not(.vueperslides--3d)
  .vueperslides__parallax-wrapper:before {
  -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
  box-shadow: 0 0 black;
}
</style>
    <script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
  components: { VueperSlides, VueperSlide },
  props: ["product"],
  data: () => ({
    slider: [],
  }),
  created() {
    var images = this.slider;
    axios.get("api/getImages/" + this.product).then((response) => {
      $.each(response.data, function (key, value) {
        images.push(value);
      });
    });
  },
  mounted() {
    // this.asNavFor1.push(this.$refs.thumbnails);
    // this.asNavFor2.push(this.$refs.main);
  },
};
</script>

