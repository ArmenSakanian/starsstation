<template>
  <div v-if="isVisible" class="modal-overlay" @click="close">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h1 class="title">{{ $t('contact') }}</h1>
        <button class="close-btn" @click="close">&times;</button>
      </div>
      <div class="modal-body">
        <p class="contact-item"><strong>{{ $t('tel') }}:</strong> <a :href="`tel:${contacts.phone}`">{{ contacts.phone }}</a></p>
        <p class="contact-item"><strong>{{ $t('email') }}:</strong> <a :href="`mailto:${contacts.email}`"> {{ contacts.email }}</a></p>
      </div>
      <div class="modal-footer">
        <div class="social-icons">
          <a v-if="contacts.socials.facebook.url" :href="contacts.socials.facebook.url" target="_blank">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a :href="contacts.socials.instagram.url" target="_blank">
        <i class="fab fa-instagram"></i>
      </a>
      <a :href="contacts.socials.youtube.url" target="_blank">
        <i class="fab fa-youtube"></i>
      </a>
        </div>
        <button @click="close" class="modal-action-btn button">Закрыть</button>
      </div>
    </div>
  </div>
</template>

<script>
import contacts from "@/contacts.json";

export default {
  data() {
    return {
      contacts,
    };
  },
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
  padding: 0 20px;
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



.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top: 1px solid #444;
  padding-top: 10px;
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

@media (max-width: 769px) {
  .modal-header {
    justify-content: center;
  }

  .close-btn {
    position: absolute;
    right: 10px;
  }
}

</style>
