<template>
  <div class="not-found">
    <div class="content">
      <img src="@/assets/notfound.png" alt="Page not found" class="error-image" />
      <h1>{{ $t('notfound') }}</h1>
      <p>{{ $t('notfound-text') }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
};
</script>

<style scoped>
.not-found {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  text-align: center;
  background-color: var(--bg-main-color);
    border-top: 1px solid var(--br-color);
    border-bottom: 1px solid var(--br-color);
}

.content {
  max-width: 600px;
  padding: 20px;
}

.error-image {
  max-width: 100%;
  height: auto;
  margin-bottom: 20px;
}

h1 {
  font-size: 2.5rem;
  color: var(--text-color);
}

p {
  font-size: 1.2rem;
  color: var(--text-secondary-color);
}
</style>