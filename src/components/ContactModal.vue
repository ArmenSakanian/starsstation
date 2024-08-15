<template>
  <div v-if="isVisible" class="modal-overlay" @click="close">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>{{ $t('contact') }}</h2>
        <button class="close-btn" @click="close">&times;</button>
      </div>
      <div class="modal-body">
        <p><strong>{{ $t('tel') }}:</strong> +1234567890</p>
        <p><strong>{{ $t('email') }}:</strong> example@example.com</p>
      </div>
      <div class="modal-footer">
        <div class="social-icons">
          <a href="#" target="_blank">
            <img src="@/assets/icon/instagram.svg" alt="Instagram" />
          </a>
          <a href="#" target="_blank">
            <img src="@/assets/icon/facebook.svg" alt="Facebook" />
          </a>
          <a href="#" target="_blank">
            <img src="@/assets/icon/youtube.svg" alt="YouTube" />
          </a>
        </div>
        <button @click="close" class="modal-action-btn">Закрыть</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isVisible: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    isVisible(newValue) {
      if (newValue) {
        this.disableScroll();
      } else {
        this.enableScroll();
      }
    }
  },
  methods: {
    disableScroll() {
      document.body.style.overflow = 'hidden';
    },
    enableScroll() {
      document.body.style.overflow = '';
    },
    close() {
      this.$emit('close');
    }
  },
  beforeDestroy() {
    this.enableScroll();
  }
};
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  background: #191A23;
  padding: 20px;
  width: 100%;
  max-width: 500px;
  border-radius: 10px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  position: relative;
  animation: modalEnter 0.5s ease-out;
  color: #ffffff;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 5px;
}

.modal-header h2 {
  margin: 0;
  font-size: 40px;
  color: #ffffff;
  background-color: #FF9900;
  padding: 7px;
}

.close-btn {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #ffffff;
}

.close-btn:hover {
  color: #cccccc;
}

.modal-body {
  padding: 20px 0;
  font-size: 20px;
  color: #ffffff;
}

.modal-body p {
  margin: 10px 0;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top: 1px solid #444;
  padding-top: 10px;
}

.social-icons {
  display: flex;
  gap: 10px;
}

.social-icons a {
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  overflow: hidden;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.social-icons img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.social-icons a:hover img {
  transform: scale(1.1);
}

.modal-action-btn {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.modal-action-btn:hover {
  background-color: #0056b3;
}

@keyframes modalEnter {
  from {
    transform: translateY(-20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
</style>
