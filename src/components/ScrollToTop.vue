<template>
  <transition name="fade">
    <div 
      v-show="visible" 
      class="scroll-to-top" 
      @click="scrollToTop"
    >
      <i class="fa-solid fa-arrow-up"></i>
    </div>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      visible: false,
    };
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    handleScroll() {
      this.visible = window.scrollY > (window.innerHeight * 0.9); // Меняем условие на 90% высоты окна
    },
    scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    },
  },
};
</script>

<style scoped>
.scroll-to-top {
  position: fixed;
  width: 50px;
  height: 50px;
  bottom: 20px;
  right: 20px;
  background-color: var(--active-color);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  font-size: 30px;
  cursor: pointer;
  z-index: 9999;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
  transform: translateY(100px);
}
</style>
