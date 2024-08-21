<template>
  <div id="section_3" class="video-container">
    <video
      ref="videoPlayer"
      class="full-screen-video-player"
      autoplay
      muted
      loop
      playsinline
    >
      <source :src="videoSource" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
  </div>
</template>

<script>
export default {
  name: 'FullScreenVideo',
  data() {
    return {
      videoSource: this.getVideoSource()
    };
  },
  methods: {
    getVideoSource() {
      return window.innerWidth < 769
        ? require('@/assets/video/main_video_mobile.mp4')
        : require('@/assets/video/main_video.mp4');
    },
    handleResize() {
      this.videoSource = this.getVideoSource();
    }
  },
  mounted() {
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  }
};
</script>

<style scoped>
.video-container {
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.full-screen-video-player {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Видео будет полностью заполнять контейнер, сохраняя пропорции */
}
</style>
