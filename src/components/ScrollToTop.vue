<template>
    <div :class="['scroll-to-top', { show: visible, intersect: intersecting }]" @click="scrollToTop">
      ↑
    </div>
  </template>
  
  <script>
  export default {
    name: 'ScrollToTop',
    data() {
      return {
        visible: false,
        intersecting: false,
      };
    },
    mounted() {
      window.addEventListener('scroll', this.handleScroll);
      this.observeTargets();
    },
    beforeDestroy() {
      window.removeEventListener('scroll', this.handleScroll);
      if (this.observer) {
        this.observer.disconnect();
      }
    },
    methods: {
      handleScroll() {
        // Измените порог с 100vh на 90vh
        this.visible = window.pageYOffset > window.innerHeight * 0.4;
      },
      scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      },
      observeTargets() {
        this.observer = new IntersectionObserver(
          (entries) => {
            let anyIntersecting = false;
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                anyIntersecting = true;
              }
            });
            this.intersecting = anyIntersecting;
          },
          { threshold: 0.1 }
        );
  
        // Using timeout to ensure all elements are loaded and rendered
        setTimeout(() => {
          const targets = document.querySelectorAll('.scroll-comp');
          targets.forEach(target => {
            this.observer.observe(target);
          });
        }, 1000);  // Adjust the timeout duration if needed
      },
    },
  };
  </script>
  
  <style scoped>
  .scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: #000;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    cursor: pointer;
    font-size: 24px;
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
    opacity: 0;
    transform: translateY(100px);
  }
  .scroll-to-top.show {
    opacity: 0.7;
    transform: translateY(0);
  }
  .scroll-to-top.intersect {
    background-color: yellow;
    color: #000;
  }
  .scroll-to-top:hover {
    opacity: 1;
  }
  </style>
  