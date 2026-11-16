<template>
  <div class="app-frame">
    <AppHeader />
    <main>
      <router-view v-slot="{ Component, route }">
        <transition name="route" mode="out-in">
          <component :is="Component" :key="route.fullPath" />
        </transition>
      </router-view>
    </main>
    <AppFooter />
    <ScrollToTop />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';
import ScrollToTop from './components/ScrollToTop.vue';

export default {
  name: 'App',
  components: { AppHeader, AppFooter, ScrollToTop }
};
</script>

<style scoped>
.app-frame {
  min-height: 100vh;
  position: relative;
  isolation: isolate;
  background: var(--bg);
}
</style>
