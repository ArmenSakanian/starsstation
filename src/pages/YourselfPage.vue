<template>
  <div class="container">
    <div class="image_container">
      <img src="@/assets/img/test.webp" alt="Rap Clip" class="image image1" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'OverlapImagesComponent',
};
</script>

<style scoped>

.container {
  min-height: 100vh;
width: 100%;
}

.image_container {
  padding-top: 100px;
    max-width: 1220px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.image {
  width: 100%;
}




</style>
